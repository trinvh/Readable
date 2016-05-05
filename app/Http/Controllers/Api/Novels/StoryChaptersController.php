<?php

namespace App\Http\Controllers\Api\Novels;

use App\Http\Controllers\Controller;
use App\Models\Novel\Chapter;
use App\Models\Novel\Story;

class StoryChaptersController extends Controller
{
    public function __construct()
    {
        //$this->middleware('throttle:10,1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($story, $chapter)
    {
        $story = Story::findBySlug($story);
        if ($story) {
            $chapter = $story->chapters()->where('slug', $chapter)->first();
            if ($chapter) {
                $chapter->text       = $chapter->content;
                $data                = app()->make('stdClass');
                $data->chapter       = $chapter;
                $data->story         = $story;
                $data->story->author = $story->authors()->first()->name;
                $data->next          = $story->chapters()->orderBy('sort_order', 'asc')->where('sort_order', '>', $chapter->sort_order)->first();
                $data->previous      = $story->chapters()->orderBy('sort_order', 'desc')->where('sort_order', '<', $chapter->sort_order)->first();
            } else {
                $data = 'Chapter not found';
            }
        } else {
            $data = 'Story not found';
        }
        return response()->json($data);
    }
}
