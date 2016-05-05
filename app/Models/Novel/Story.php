<?php

namespace App\Models\Novel;

use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;

class Story extends Model implements \Cviebrock\EloquentSluggable\SluggableInterface
{
    use Traits\Sortable;
    use Traits\HasManyRender;
    use SoftDeletes, SluggableTrait;
    use Eloquence;

    protected $table = "s_stories";

    protected $fillable = ['name', 'description', 'photo', 'viewed'];

    protected $hidden = ['id', 'deleted_at', 'created_at'];

    public static $rules = [
        'name'   => 'required',
        'viewed' => 'required|integer|min:0',
    ];

    protected $searchableColumns = ['name', 'authors.name'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 's_story_category', 'story_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 's_story_tag', 'story_id', 'tag_id');
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 's_story_author', 'story_id', 'author_id');
    }

    public function sources()
    {
        return $this->belongsToMany(Source::class, 's_story_source', 'story_id', 'source_id')
            ->orderBy('pivot_priority', 'desc')
            ->withPivot('url', 'data', 'priority');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'story_id');
    }

    public function files()
    {
        return $this->hasMany(File::class, 'story_id');
    }

    public function syncAuthors($authors)
    {
        if ($authors == "") {
            return;
        }

        $authors = collect(array_map('trim', explode(',', $authors)))
            ->map(function ($author, $i) {
                return Author::firstOrCreate(['name' => $author])->id;
            })->toArray();
        $this->authors()->sync($authors);
    }

    public function getLastChapterAttribute()
    {
        return $this->chapters()->orderBy('sort_order', 'desc')->first();
    }

}
