<?php

namespace App\Models\Novel;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Collection extends Model implements \Cviebrock\EloquentSluggable\SluggableInterface
{
    use SluggableTrait;
    
    protected $table = "s_collections";
    
    protected $fillable = ['name', 'photo', 'description', 'slug'];
    
    public static $rules = [
        'name'  => 'required'  
    ];
    
    public function stories() {
        return $this->belongsToMany(Story::class, 's_story_collection', 'collection_id', 'story_id');
    }
}
