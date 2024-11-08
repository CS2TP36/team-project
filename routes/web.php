<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// page can be accessed at site/test
Route::get('/test', function () {
    return view('pages.test');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/aboutus', function () {
    return view('pages.aboutus');
});
Route::get('/register', function () {
    return view('pages.register');
});
