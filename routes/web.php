<?php

use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\PassChangeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PreviousOrders;
use App\Http\Controllers\ProductLister;
use App\Http\Controllers\ProductSearcher;
use App\Http\Controllers\ShowProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BasketController;

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Show the registration form
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');

// Handle registration form submission
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Redirect any route access to the home page at /home
Route::redirect('/', '/home');

// Handles the account page
Route::get('/account', [AccountController::class, 'show'])->middleware('auth');

// Show the home page
Route::get('/home', function () {
    return view('pages.home');
});

// Page can be accessed at site/test
/*
Route::get('/test', function () {
    return view('pages.test');
});
*/


// Show the login page
Route::get('/login', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/home');
    }
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

Route::get('/forgot-pass', function () {
    return view('pages.forgot-pass');
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
Route::get('/checkout', [CheckoutController::class, 'index'])->name('basket.show');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');


Route::get('/search/{searchTerm}', [ProductSearcher::class, 'show'])->name('products.search');

// Shows the Basket index
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');

// Add items to the Basket
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');

//Updates the quantity of an item in the Basket
Route::patch('/basket/update/{id}', [BasketController::class, 'update'])->name('basket.update');

// Deletes a product from the Basket
Route::delete('/basket/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.checkout');

Route::get('/change-pass', [PassChangeController::class, 'show'])->name('change-pass.show');

Route::post('/change-pass', [PassChangeController::class, 'change'])->name('change-pass.change');

Route::get('/terms-conditions', function () {
    return view('pages.terms-conditions');
});

Route::get('/orders', [PreviousOrders::class, 'show'])->name('orders.show');

// admin routes

// by default go to admin account page
Route::get('/admin', function () {
    return redirect(route('admin.account'));
})->name('admin');

Route::get('/admin/account', function () {
    return view('pages.admin.account');
})->name('admin.account');
