<?php namespace App\Services\Exporters;

use EPub;

class EpubExporterService extends IExporterService
{

    public function __construct($story)
    {
        $this->type = 'epub';
        $this->book = new Epub();

        parent::__construct($story);
    }

    private function createEpub()
    {
        $this->book->setTitle($this->story->name);
        $authors = $this->story->showMany('authors');
        $this->book->setAuthor($authors, $authors);

        $this->book->setIdentifier(url('?timestamps=' . time()), EPub::IDENTIFIER_URI);

        $this->book->setLanguage('vi');

        $cover = view('exporters.epub-cover')->withStory($this->story)->render();

        $this->book->addChapter('Notices', 'Cover.html', $cover);

        $this->book->buildTOC();

        foreach ($this->story->chapters()->sort()->get() as $chapter) {
            $chapter_name     = 'Chương ' . $chapter->sort_order;
            $chapter_filename = 'Chapter' . $chapter->sort_order . '.html';
            $chapter_html     = view('exporters.epub-chapter')->withChapter($chapter)->render();

            $this->book->addChapter($chapter_name, $chapter_filename, $chapter_html);
        }

        $this->book->finalize();
    }

    public function exportAndDownload()
    {
        $this->createEpub();
        $zipData = $this->book->sendBook($this->story->slug);
    }

    public function export()
    {
        if ($this->checkFileExists()) {
            return $this->file;
        }
        $this->createEpub();
        $zipData = $this->book->saveBook($this->story->slug, $this->savePath);

        $filePath = $this->savePath . '/' . $zipData;
        $this->saveToDatabase($filePath);

        return $filePath;
    }
}
