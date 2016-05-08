<?php
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::get('test', function () {
    return auth()->guard('api')->user();
});

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
    'namespace'  => 'Api',
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


