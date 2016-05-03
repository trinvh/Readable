<?php

namespace App\Models\Novel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{
    use SoftDeletes;
    
    protected $table = "s_sources";
    
    protected $fillable = ['name'];
    
    public function stories() {
        return $this->belongsToMany(Story::class, 's_story_source', 'source_id', 'story_id');
    }
    
    /*
     * Source Handler - which process all works related with story
    */
    private $source_handler;
    
    public function scanNewStories() {
        $this->source_handler = new $this->smodel($this);       
        return $this->source_handler->scanNewStories();
    }
    
    public function updateStoryInfo($story) {
        $this->source_handler = new $this->smodel($this);
        return $this->source_handler->updateStoryInfo($story);
    }
    
    public function updateChapters($story) {
        $this->source_handler = new $this->smodel($this);
        return $this->source_handler->updateChapters($story);
    }
}
