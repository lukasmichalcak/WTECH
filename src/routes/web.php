<?php

use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProductNewController;
use App\Http\Controllers\ProductListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
//use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Header\HeaderController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserDetails\UserDetailsController;
use App\Http\Controllers\Paywall\CartController;
use App\Http\Controllers\Paywall\InvoiceController;
use App\Http\Controllers\Paywall\ShippingController;
use App\Http\Controllers\Paywall\PaymentController;
use App\Http\Controllers\ProductPageController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [ProductPageController::class, 'show'])->name('product.show');
Route::get('/product-admin/{id}', [ProductAdminController::class, 'show'])->name('product.admin');
Route::post('/product-admin/update/{id}', [ProductAdminController::class, 'update'])->name('product-admin.update');
Route::delete('/product-admin/delete', [ProductAdminController::class, 'deleteImage'])->name('product.admin.delete');
Route::delete('/product-admin/{id}', [ProductAdminController::class, 'destroy'])->name('product.admin.destroy');




Route::get('/product-new', [ProductNewController::class, 'create'])->name('product.new');


Route::get('/products-list', [ProductListController::class, 'show'])->name('products.list');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Route::get('/profile', [HeaderController::class, 'profile'])->name('profile');
Route::get('/orders', [HeaderController::class, 'orders'])->name('orders');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/user/name/update', [UserDetailsController::class, 'updateName'])->name('name.update');

Route::post('/address/{id}/update', [UserDetailsController::class, 'updateAddress'])->name('address.update');
Route::delete('/address/{id}/delete', [UserDetailsController::class, 'deleteAddress'])->name('address.delete');
Route::post('/address/store', [UserDetailsController::class, 'storeAddress'])->name('address.store');

Route::post('/card/{id}/update', [UserDetailsController::class, 'updateCard'])->name('card.update');
Route::delete('/card/{id}/delete', [UserDetailsController::class, 'deleteCard'])->name('card.delete');
Route::post('/card/store', [UserDetailsController::class, 'storeCard'])->name('card.store');

Route::get('/cart', [CartController::class, 'cart'])->name('paywall.cart');
Route::get('/invoice', [InvoiceController::class, 'invoice'])->name('paywall.invoice');
Route::get('/shipping', [ShippingController::class, 'shipping'])->name('paywall.shipping');
Route::get('/payment', [PaymentController::class, 'payment'])->name('paywall.payment');

Route::post('/cart/increase', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/cart/decrease', [CartController::class, 'decrease'])->name('cart.decrease');

Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoice.store');
Route::post('/shipping/store', [ShippingController::class, 'store'])->name('shipping.store');
Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');
Route::post('/payment/finalize', [PaymentController::class, 'finalize'])->name('payment.finalize');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

//DEBUG SESSION
Route::get('/debug-session', function () {
    return response()->json(session()->all());
});




