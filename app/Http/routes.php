<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();

Route::get('api/v1/novels/stories', function() {
    $limit = Request::has('limit') ? Request::get('limit') : 20;
    return App\Models\Novel\Story::paginate($limit);
});

Route::get('api/v1/novels/stories/{slug}', function($slug) {
    $story = App\Models\Novel\Story::with('chapters', 'authors', 'tags', 'categories')->whereSlug($slug)->first();
    return response()->json($story);
});

Route::get('api/v1/novels/stories/{story}/{slug}', function($story, $slug) {
    $story = App\Models\Novel\Story::findBySlug($story);
    if($story) {
        $chapter = $story->chapters()->where('slug', $slug)->first();
        if($chapter) {            
            $chapter->text = $chapter->content;
            $data = new StdClass;
            $data->chapter = $chapter;
            $data->story = $story;
            $data->story->author = $story->authors()->first()->name;            
            $data->next = $story->chapters()->orderBy('sort_order', 'asc')->where('sort_order', '>', $chapter->sort_order)->first();
            $data->previous = $story->chapters()->orderBy('sort_order', 'desc')->where('sort_order', '<', $chapter->sort_order)->first();
        } else {
            $data = 'Chapter not found';
        }
    } else {
        $data = 'Story not found';
    }
    return response()->json($data);
});

Route::get('run-command', function() {
    //$command = new App\Console\Commands\DailyScanStoriesFromSourcesCommand();
    //$command = new App\Console\Commands\DailyUpdateStoryCommand();
    $command = new App\Console\Commands\DailyUpdateChaptersCommand();
    return $command->handle();
});

require __DIR__ . '/Routes/Frontend.php';

Route::group([
    'prefix'        => 'admin',
    'middleware'    => ['auth', 'acl'],
    'is'            => 'administrator'], 
function() {        
    require __DIR__ . '/Routes/Backend/Dashboard.php';
    require __DIR__ . '/Routes/Backend/Novel.php';
});

