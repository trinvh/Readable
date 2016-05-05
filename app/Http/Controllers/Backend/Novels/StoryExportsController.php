<?php

namespace App\Http\Controllers\Backend\Novels;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Novel\Story;
use App\Services\Exporters\EpubExporterService;

class StoryExportsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string $type
     * @return \Illuminate\Http\Response
     */
    public function show($story_id, $type)
    {
        $story = Story::findOrFail($story_id);
        
        $exporter = new EpubExporterService($story);
        return $exporter->export();
        
    }

}
