<?php

Route::group(['prefix' => 'novels'], function() {
    Route::resource('stories', 'Backend\Novels\StoriesController');
    
    Route::resource('stories.chapters', 'Backend\Novels\StoryChaptersController',
        ['only' => ['index']]);
        
    Route::resource('chapters', 'Backend\Novels\ChaptersController');
    
    Route::resource('categories', 'Backend\Novels\CategoriesController');
});