<?php

Route::post('auth/login', 'AuthController@login');
Route::post('auth/signup', 'AuthController@signup');
Route::post('auth/facebook', 'AuthController@facebook');

Route::group(['prefix' => 'novels', 'namespace' => 'Novels'], function () {

    Route::controller('home', 'HomeController');

    Route::resource('stories', 'StoriesController',
        ['only' => ['index', 'show']]);
    Route::resource('stories.chapters', 'StoryChaptersController',
        ['only' => ['show']]);
    Route::resource('stories.exporters', 'StoryExportersController',
        ['only' => ['show']]);
});
