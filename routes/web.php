<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// page can be accessed at site/test
Route::get('/test', function () {
    return view('pages.test');
});
