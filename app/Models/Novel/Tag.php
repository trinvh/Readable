<?php

namespace App\Models\Novel;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Tag extends Model implements \Cviebrock\EloquentSluggable\SluggableInterface
{
    use SluggableTrait;
    use Traits\Sortable;
    
    protected $table = "s_tags";
    
    protected $fillable = ['name'];
    
    protected $hidden = ['id', 'created_at','updated_at', 'pivot'];
    
    public function stories() {
        return $this->belongsToMany(Story::class, 's_story_tag', 'tag_id', 'story_id');
    }
}
