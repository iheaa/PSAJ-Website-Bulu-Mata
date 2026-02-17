<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/gallery', function () {
    return view('gallery');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/signin', [AuthController::class , 'showSignIn'])->name('signin');
Route::post('/signin', [AuthController::class , 'login'])->name('login'); // Alias login for auth middleware
Route::get('/signup', [AuthController::class , 'showSignUp'])->name('signup');
Route::post('/signup', [AuthController::class , 'store']);
Route::post('/logout', [AuthController::class , 'logout'])->name('logout');

// Added Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
});

// Public Catalog & Cart Routes
Route::get('/catalog', [App\Http\Controllers\PublicCatalogController::class , 'index'])->name('catalog.index');
Route::get('/product/{id}', [App\Http\Controllers\ProductDetailController::class , 'show'])->name('product.detail');
Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class , 'addToCart'])->name('cart.add');
Route::get('/cart', [App\Http\Controllers\CheckoutController::class , 'index'])->name('cart.index');
Route::get('/checkout-details', [App\Http\Controllers\CheckoutController::class , 'checkout'])->middleware('auth')->name('checkout.details');
Route::post('/checkout/process', [App\Http\Controllers\CheckoutController::class , 'processPayment'])->name('checkout.process')->middleware('auth');
Route::get('/payment/finish', [App\Http\Controllers\CheckoutController::class , 'paymentSuccess'])->name('payment.finish')->middleware('auth');
Route::get('/checkout/success/{id}', [App\Http\Controllers\CheckoutController::class , 'success'])->name('checkout.success')->middleware('auth');
Route::patch('/cart/update/{id}', [App\Http\Controllers\CheckoutController::class , 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{id}', [App\Http\Controllers\CheckoutController::class , 'removeItem'])->name('cart.remove');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\CatalogController::class , 'dashboard'])->name('dashboard');
    Route::resource('catalogs', App\Http\Controllers\CatalogController::class);
});

// User Orders Routes
Route::middleware('auth')->group(function () {
    Route::get('/orders', [App\Http\Controllers\OrderController::class , 'index'])->name('orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\OrderController::class , 'show'])->name('orders.show');
});