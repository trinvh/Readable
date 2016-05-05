<?php

namespace App\Models\Novel;

use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements \Cviebrock\EloquentSluggable\SluggableInterface
{
    use SoftDeletes, SluggableTrait;
    use Traits\Sortable;

    protected $table = "s_categories";

    protected $fillable = ['name', 'description'];

    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at', 'pivot', 'description', 'active'];

    public static $rules = [
        'name' => 'required',
    ];

    public function stories()
    {
        return $this->belongsToMany(Story::class, 's_story_category', 'category_id', 'story_id');
    }

}
