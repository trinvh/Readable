<?php

Route::resource('filemanager', 'Backend\FileController');
Route::controller('filemanager', 'Backend\FileController',
    ['postFolder' => 'admin.filemanager.folder']
);
