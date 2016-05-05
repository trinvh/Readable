<?php

Route::group(['prefix' => 'novels', 'namespace' => 'Api\Novels'], function () {

    Route::controller('home', 'HomeController');

    Route::resource('stories', 'StoriesController',
        ['only' => ['index', 'show']]);
    Route::resource('stories.chapters', 'StoryChaptersController',
        ['only' => ['show']]);
    Route::resource('stories.exporters', 'StoryExportersController',
        ['only' => ['show']]);
});
