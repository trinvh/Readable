<?php

namespace App\Models\Novel\SourceHandlers;

use App\Models\Helpers\Html2Text;
use App\Models\Novel\Author;
use App\Models\Novel\Category;
use App\Models\Novel\Chapter;
use App\Models\Novel\Source;
use App\Models\Novel\Story;
use App\Models\Novel\Tag;

abstract class BaseSourceHandler
{
    public $story_pattern = ".view-content > ul > li.book-row";

    public $story_name_pattern = ".book-truyen > a";

    public $story_author_pattern = ".book-tacgia > a";

    public $story_link_pattern = ".book-truyen > a";

    protected $source;

    public function __construct(Source $source)
    {
        $this->source = $source;
    }

    public function scanNewStories()
    {
        $crawler = $this->getContent($this->source->url);

        $urls = $crawler->filter($this->story_pattern)->each(function ($node, $i) {
            $authors_text = $node->filter($this->story_author_pattern)->first()->text();

            $authors = array_map('trim', explode(',', $authors_text));
            $name    = $node->filter($this->story_name_pattern)->first()->text();
            $link    = $node->filter($this->story_link_pattern)->first()->link()->getUri();

            $exists = Story::where('name', $name)->whereHas('authors', function ($q) use ($authors) {
                $q->whereIn('name', $authors);
            })->exists();

            if (!$exists) {
                $story = Story::create(['name' => $name]);
                $this->source->stories()->save($story, ['url' => $link]);
                foreach ($authors as $author) {
                    $inserted_author = Author::firstOrCreate(['name' => $author]);
                    $story->authors()->sync([$inserted_author->id], false);
                }

                $this->updateStoryInfo($story);
            }
        });
    }

    // TODO: Implements reusable variables
    public function updateStoryInfo($story)
    {
        $node = $this->getContent($this->source->pivot->url);

        // Bypass following if story has any chapter
        if (is_null($story->chapters)) {
            $thumbnail        = $node->filter("#anhbia > img")->attr('src');
            $description_html = $node->filter('#gioithieu')->count() > 0 ? $node->filter('#gioithieu')->html() : "";
            $html2text        = new Html2Text($description_html);
            $description      = $html2text->getText();

            $categories = $node->filter('#theloai > a')->each(function ($node, $i) use ($story) {
                $category = Category::firstOrCreate(['name' => $node->text()]);
                $story->categories()->sync([$category->id], false);
            });

            $story->description = $description;
            $story->photo       = $thumbnail;
            $story->save();
        }

        $tags = $node->filter('#flag > span.flag-term')->each(function ($node, $i) use ($story) {
            $tag = Tag::firstOrCreate(['name' => $node->text()]);
            $story->tags()->sync([$tag->id], false);
        });
    }

    public function updateChapters($story)
    {
        if ($story->chapters->count() <= 0) {
            $catalog_url = $this->getCatalogueUrl();
            $node        = $this->getContent($catalog_url);
            $catalogue   = $node->filter('.mucluc-chuong > a');
            if ($catalogue->count() > 0) {
                $first_chapter_url = $catalogue->link()->getUri();
                $node              = $this->getContent($first_chapter_url);

                $this->saveChapter($story, $first_chapter_url, $node);

                // Continue...
                $this->updateChapters($story);
            }
        } else {
            $last_chap_url = $story->chapters()->orderBy('sort_order', 'desc')->first()->source_url;
            $node          = $this->getContent($last_chap_url);
            $next_chap     = $node->filter('.chuong-nav > .page-next');
            if ($next_chap->count() > 0) {
                $next_chapter_url = $next_chap->link()->getUri();
                if (!Chapter::where('source_url', $next_chapter_url)->exists()) {
                    $node = $this->getContent($next_chapter_url);
                    $this->saveChapter($story, $next_chapter_url, $node);

                    // Continue...
                    $this->updateChapters($story);
                }
            }
        }
        // save chapter with new timestamps
        // job activities will base on
        $story->save();
    }

    /**** PROTECTED FUNCTIONS *****/

    protected function saveChapter($story, $url, $node)
    {
        $info_node = $node->filter('div#info')->count() > 0 ? $node->filter('div#info')->html() : '';
        $html2text = new Html2Text($info_node);
        $chap_info = $html2text->getText();

        $content_node = $node->filter('div#noidung')->html();
        $html2text    = new Html2Text($content_node);
        $chap_content = $html2text->getText();

        $chap_name  = $node->filter('header > h1.page__title')->text();
        $sort_order = $story->chapters()->max('sort_order') + 1;
        $story->chapters()->save(
            new Chapter([
                'name'       => $chap_name,
                'info'       => $chap_info,
                'content'    => $chap_content,
                'sort_order' => $sort_order,
                'source_url' => $url,
            ])
        );
    }
    protected function getCatalogueUrl()
    {
        return $this->source->pivot->url;
    }

    protected function getContent($url)
    {
        return \Goutte::request('GET', $url);
    }
}
