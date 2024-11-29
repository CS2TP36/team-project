<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


// redirects any route site access to the home page at /home
Route::redirect('/', '/home');

Route::get('/home', function () {
    return view('pages.home');
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


Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/products', function () {
    return view('pages.products');
});


