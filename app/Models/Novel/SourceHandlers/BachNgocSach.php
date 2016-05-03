<?php

namespace App\Models\Novel\SourceHandlers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Novel\Source;

class BachNgocSach extends BaseSourceHandler
{
    public function scanNewStories() { 
        return parent::scanNewStories();   
    }
    
    public function updateStoryInfo($story) {
        return parent::updateStoryInfo($story);   
    }
    
    public function updateChapters($story) {
        return parent::updateChapters($story);
    }
    
    protected function getCatalogueUrl() {
        return $this->source->pivot->url . '/muc-luc';
    }

}
