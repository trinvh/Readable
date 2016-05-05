<?php

namespace App\Models\Novel;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Chapter extends Model implements \Cviebrock\EloquentSluggable\SluggableInterface
{
    use SluggableTrait;
    
    protected $table = "s_chapters";
    
    protected $fillable = ['name', 'info', 'content', 'sort_order', 'source_url'];
    
    protected $hidden = ['content', 'info', 'source_url', 'created_at', 'updated_at', 'story_id', 'id'];
    
    // DO NOT use this because it will update every time the viewed count increase
    protected $touches = ['story'];
    
    public function story() {
        return $this->belongsTo(Story::class, 'story_id');
    }
    
    public function scopeSort($query) {
        return $query->orderBy('sort_order', 'asc');
    }
}
