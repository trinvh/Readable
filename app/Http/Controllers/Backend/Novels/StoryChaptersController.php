<?php

namespace App\Http\Controllers\Backend\Novels;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Novel\Chapter;
use App\Models\Novel\Story;

class StoryChaptersController extends Controller
{
    public function index($storyid)
    {
        $story = Story::findOrFail($storyid);
        $chapters = $story->chapters()->orderBy('sort_order', 'asc')->paginate(20);
        return view('backend.novels.chapters.index')
            ->withStory($story)
            ->withChapters($chapters);
    }

}
