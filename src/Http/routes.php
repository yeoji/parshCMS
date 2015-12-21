<?php

Route::get('/', function() {
    return view('parshcms::dashboard');
});

Route::get('/themes/{id}/preview', 'ThemeController@getPreview');
Route::resource('themes', 'ThemeController', ['except' => 'show']);

Route::resource('pages', 'PageController');