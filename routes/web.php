<?php

use App\Http\Controllers\AddressStorageController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ManageUsersController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\AccountController;
use App\Http\Controllers\Auth\ForgotPassController;
use App\Http\Controllers\Auth\PassChangeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PreviousOrdersController;
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
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AddressController;

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::redirect('/', '/home');

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
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.checkout');

Route::get('/search/{searchTerm}', [ProductSearcher::class, 'show'])->name('products.search');

// Shows the Basket index
Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::post('/basket/add', [BasketController::class, 'add'])->name('basket.add');
Route::patch('/basket/update/{id}', [BasketController::class, 'update'])->name('basket.update');
Route::delete('/basket/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove');

// wishlist stuff
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/change-pass', [PassChangeController::class, 'show'])->name('change-pass.show');
Route::post('/change-pass', [PassChangeController::class, 'change'])->name('change-pass.change');

Route::get('/terms-conditions', function () {
    return view('pages.terms-conditions');
});

// previous orders routes
Route::get('/orders', [PreviousOrdersController::class, 'show'])->name('orders.show');
Route::get('/orders/more', [PreviousOrdersController::class, 'loadMore'])->name('orders.more');

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
Route::patch('/admin/manage-users/{id}/update-role', [ManageUsersController::class, 'updateRole'])->name('admin.update-role');
Route::delete('/admin/manage-users/{id}', [ManageUsersController::class, 'destroy'])->name('admin.delete-user');

Route::get('/search-preview/{searchTerm}', [ProductSearcher::class, 'searchPreview'])->name('search.preview');

Route::get('/account', [AccountController::class, 'show'])->name('account.page');
Route::post('/account/update', [AccountController::class, 'update'])->name('account.update');
Route::delete('/account/delete', [AccountController::class, 'destroy'])->name('account.delete');
Route::get('/account/contact-details', [AccountController::class, 'showContactDetails'])->name('account.contact-details');

// Address routes (more specific routes first!)
Route::get('/account/addresses', [AddressController::class, 'index'])->name('account.addresses');
Route::get('/account/addresses/create', [AddressController::class, 'create'])->name('address.create');
Route::post('/account/addresses/store', [AddressController::class, 'store'])->name('address.store');
Route::get('/account/addresses/{address}/edit', [AddressController::class, 'edit'])->name('address.edit');
Route::put('/account/addresses/{address}', [AddressController::class, 'update'])->name('address.update');
Route::delete('/account/addresses/{address}', [AddressController::class, 'destroy'])->name('address.destroy');

Route::get('/account/payments', [PaymentMethodController::class, 'index'])->name('account.payments');
Route::get('/account/payments/create', [PaymentMethodController::class, 'create'])->name('payment.create');
Route::post('/account/payments/store', [PaymentMethodController::class, 'store'])->name('payment.store');
Route::get('/account/payments/{id}/edit', [PaymentMethodController::class, 'edit'])->name('payment.edit');
Route::put('/account/payments/{id}', [PaymentMethodController::class, 'update'])->name('payment.update');
Route::delete('/account/payments/{id}', [PaymentMethodController::class, 'destroy'])->name('payment.destroy');

// careers page route
Route::get('/careers', function () {
    return view('pages.careers');
});

Route::get('/sponsor', function () {
    return view('pages.sponsor');
});

Route::get('/sustainability', function () {
    return view('pages.sustainability');
});

Route::get('/account-payments', function () {
    return view('pages.account-payments');
});
