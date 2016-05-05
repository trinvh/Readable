<?php

namespace App\Http\Controllers\Api\Novels;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Novel\Story;
use App\Services\Exporters\EpubExporterService;

class StoryExportersController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  string fileType = ['epub', 'pdf', 'mobi']
     * @return \Illuminate\Http\Response
     */
    public function show($story_id, $fileType)
    {
        $story = Story::findBySlug($story_id);
        if($story) {        
            $exporter = new EpubExporterService($story);
            return ['url' => url($exporter->export())];
        }
        return ['error' => 'Story not found'];
    }
}
