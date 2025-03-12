<?php

use App\Http\Controllers\AddressStorage;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\ForgotPassController;
use App\Http\Controllers\Auth\PassChangeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PreviousOrders;
use App\Http\Controllers\ProductLister;
use App\Http\Controllers\ProductSearcher;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShowProduct;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\Admin\ProductManagementController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;


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

Route::get('/products/{mens?}/{sortBy?}/{ascending?}/{catFilter?}/{priceFilter?}', [ProductLister::class, 'show'])->name('products.show');
Route::get('/product/{id?}', [ShowProduct::class, 'show'])->name('product.show');


// Show the checkout page
Route::get('/checkout', [CheckoutController::class, 'index'])->name('basket.show');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');


Route::get('/search/{searchTerm}', [ProductSearcher::class, 'show'])->name('products.search');

// Shows the Basket index
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
Route::patch('/basket/update/{id}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove');

//wishlist stuff
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');


Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.checkout');

Route::get('/change-pass', [PassChangeController::class, 'show'])->name('change-pass.show');
Route::post('/change-pass', [PassChangeController::class, 'change'])->name('change-pass.change');

Route::get('/terms-conditions', function () {
    return view('pages.terms-conditions');
});



// previous orders routes
Route::get('/orders', [PreviousOrders::class, 'show'])->name('orders.show');
Route::get('/orders/more', [PreviousOrders::class, 'loadMore'])->name('orders.more');

Route::get('/admin', [\App\Http\Controllers\Admin\AccountController::class, 'show'])->name('admin');

Route::get('/admin/account', [\App\Http\Controllers\Admin\AccountController::class, 'show'])->name('admin.account');

Route::get('/admin/reports', [ReportController::class, 'show'])->name('admin.reports');

Route::post('/admin/slevels', [ReportController::class, 'stockLevelForm'])->name('admin.reports.stockLevelForm');

Route::get('/delivery-and-returns', function () {
    return view('pages.delivery-and-returns');
})->name('delivery.returns');


Route::get('/admin/products', [ProductManagementController::class, 'index'])->name('admin.products.index');
Route::get('/admin/products/create', [ProductManagementController::class, 'create'])->name('admin.products.create');
Route::post('/admin/products', [ProductManagementController::class, 'store'])->name('admin.products.store');
Route::get('/admin/products/{product}/edit', [ProductManagementController::class, 'edit'])->name('admin.products.edit');
Route::put('/admin/products/{product}', [ProductManagementController::class, 'update'])->name('admin.products.update');
Route::delete('/admin/products/{product}', [ProductManagementController::class, 'destroy'])->name('admin.products.destroy');


// Show the review page
Route::get('/review/{productId}', [ReviewController::class, 'show'])->name('review.show');

Route::post('/review/add', [ReviewController::class, 'add'])->name('review.add');

Route::get('/privacy-policy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/admin/messages/{page?}', [ContactController::class, 'show'])->name('admin.messages');

Route::get('/forgot-pass', [ForgotPassController::class, 'show'])->name('forgot-pass.show');
Route::post('/forgot-pass', [ForgotPassController::class, 'change'])->name('forgot-pass.change');

Route::get('/faq', function () {
    return view('pages.faq');
});

// show admin manage users
Route::get('/admin/manage-users', [ManageUsersController::class, 'show'])->name('admin.manage-users');

Route::get('/admin/discounts', [DiscountController::class, 'show'])->name('admin.discounts');
Route::post('/admin/discounts', [DiscountController::class, 'add'])->name('admin.discounts.add');

Route::get('/search-preview/{searchTerm}', [ProductSearcher::class, 'searchPreview'])->name('search.preview');

// stuff for getting the various account pages defined via accountcontroller
Route::get('/account', [AccountController::class, 'show'])->name('account.page');
Route::get('/account/{page?}', [AccountController::class, 'show'])->name('account.subpage');

// address routes
Route::get('/address/add', [AddressStorage::class, 'showAdd']);
Route::get('/address/edit', [AddressStorage::class, 'showEdit']);

// careers page route
Route::get('/careers', function () {
    return view('pages.careers');
});

Route::get('/sponsor', function () {
    return view('pages.sponsor');
});
