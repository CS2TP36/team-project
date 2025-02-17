<?php

use App\Http\Controllers\Admin\ReportController;
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
use App\Http\Controllers\Admin\ProductManagementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;


Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::redirect('/', '/home');

Route::get('/account', [AccountController::class, 'show'])->middleware('auth');

Route::get('/home', function () {
    return view('pages.home');
});

Route::get('/login/{redirect?}', [LoginController::class, 'show'])->name('login.show');
Route::get('/aboutus', function () {
    return view('pages.aboutus');
});
Route::get('/contact', function () {
    return view('pages.contact');
});
Route::get('/forgot-pass', function () {
    return view('pages.forgot-pass');
});
Route::get('/account', [AccountController::class, 'show'])->name('account.show');

Route::get('/products/{mens?}/{sortBy?}/{ascending?}/{catFilter?}/{priceFilter?}', [ProductLister::class, 'show'])->name('products.show');
Route::get('/product/{id?}', [ShowProduct::class, 'show'])->name('product.show');

// Show the previous orders page
Route::get('/previous-orders', [PreviousOrders::class, 'show'])->name('previous-orders.show');



// Show the checkout page
Route::get('/checkout', [CheckoutController::class, 'index'])->name('basket.show');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');


Route::get('/search/{searchTerm}', [ProductSearcher::class, 'show'])->name('products.search');

// Shows the Basket index
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
Route::patch('/basket/update/{id}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.checkout');

Route::get('/change-pass', [PassChangeController::class, 'show'])->name('change-pass.show');
Route::post('/change-pass', [PassChangeController::class, 'change'])->name('change-pass.change');

Route::get('/terms-conditions', function () {
    return view('pages.terms-conditions');
});

Route::get('/orders', [PreviousOrders::class, 'show'])->name('orders.show');

Route::get('/admin', function () {
    return redirect(route('admin.account'));
})->name('admin');

Route::get('/admin/account', function () {
    return view('pages.admin.account');
})->name('admin.account');

Route::get('/admin/reports', function () {
    return view('pages.admin.stock-reports');
})->name('admin.reports');

Route::post('/admin/slevels', [ReportController::class, 'stockLevelForm'])->name('admin.reports.stockLevelForm');

Route::get('/delivery-and-returns', function () {
    return view('pages.delivery-and-returns');
})->name('delivery.returns');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/products', [ProductManagementController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductManagementController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductManagementController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [ProductManagementController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [ProductManagementController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [ProductManagementController::class, 'destroy'])->name('admin.products.destroy');
});

// Show the review page
Route::get('/review', function () {
    return view('pages.review');
});
