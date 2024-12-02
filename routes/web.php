<?php

use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\ProductLister;
use App\Http\Controllers\ShowProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Show the registration form
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');

// Handle registration form submission
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Redirect any route access to the home page at /home
Route::redirect('/', '/home');

// Show the home page
Route::get('/home', function () {
    return view('pages.home');
});

// Page can be accessed at site/test
Route::get('/test', function () {
    return view('pages.test');
});

// Show the login page
Route::get('/login', function () {
    return view('pages.login');
});

// Show the about us page
Route::get('/aboutus', function () {
    return view('pages.aboutus');
});

// Show the contact page
Route::get('/contact', function () {
    return view('pages.contact');
});

// Show the Account page
Route::get('/account', [AccountController::class, 'show'])->name('account.show');

// Show the products page
// for example http://site/products/0/name/1 -> returns page with womens products sorted by name ascending
Route::get('/products/{mens?}/{sortBy?}/{ascending?}/{catFilter?}/{priceFilter?}', [ProductLister::class, 'show'])->name('products.show');

// Show the product page
Route::get('/product/{id}', [ShowProduct::class, 'show'])->name('product.show');

// Show the basket page
Route::get('/basket', function () {
    return view('pages.basket');
});

// Show the checkout page
Route::get('/checkout', function () {
    return view('pages.checkout');
});
