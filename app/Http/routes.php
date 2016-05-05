<?php

// Image cache & resize handle
Route::get('images/{width}/{height}/{filename}', 'ImageController@getResize')
    ->where(['width' => '[0-9]+', 'height' => '[0-9]+', 'filename' => '(.+)']);

// NORMAL AUTH
Route::auth();

Route::get('run-command', function () {
    $story   = \App\Models\Novel\Story::find(78);
    $source  = $story->sources->first();
    $results = $source->updateChapters($story);
    return $results;
});

/**** API ROUTES ****/
Route::group([
    'prefix'     => 'api/v1',
    'middleware' => ['api', 'cors'],
], function () {
    require __DIR__ . '/Routes/Api.php';
});

/**** FRONTEND ROUTES ****/
require __DIR__ . '/Routes/Frontend.php';

/*** ADMIN ROUTES ****/
Route::group([
    'prefix'     => 'admin',
    'middleware' => ['auth', 'acl'],
    'is'         => 'administrator',
], function () {
    require __DIR__ . '/Routes/Backend/Dashboard.php';
    require __DIR__ . '/Routes/Backend/FileManager.php';
    require __DIR__ . '/Routes/Backend/Novel.php';
});

Route::get('test', function () {
    $chap = \App\Models\Novel\Chapter::first();
    return view('exporters.epub-chapter')->withChapter($chap);
});
