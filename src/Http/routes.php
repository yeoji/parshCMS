<?php

Route::get('/', function() {
    return view('parshcms::dashboard');
});

Route::resource('themes', 'ThemeController');