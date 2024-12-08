<?php

use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\PassChangeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductLister;
use App\Http\Controllers\ProductSearcher;
use App\Http\Controllers\ShowProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BasketController;

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/home');
    }
    return view('pages.login');
})->name('login');

// Home and static pages
Route::redirect('/', '/home');
Route::get('/home', function () {
    return view('pages.home');
})->name('home');
Route::get('/aboutus', function () {
    return view('pages.aboutus');
})->name('aboutus');
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Account management
Route::get('/account', [AccountController::class, 'show'])->middleware('auth')->name('account.show');
Route::get('/change-pass', [PassChangeController::class, 'show'])->name('change-pass.show');
Route::post('/change-pass', [PassChangeController::class, 'change'])->name('change-pass.change');

// Product-related routes
Route::get('/products/{mens?}/{sortBy?}/{ascending?}/{catFilter?}/{priceFilter?}', [ProductLister::class, 'show'])->name('products.show');
Route::get('/product/{id}', [ShowProduct::class, 'show'])->name('product.show');
Route::get('/search/{searchTerm}', [ProductSearcher::class, 'show'])->name('products.search');

// Basket Routes
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
Route::patch('/basket/update/{id}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove');

// Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->middleware('auth')->name('checkout.checkout');