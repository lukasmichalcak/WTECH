<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Header\HeaderController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\UserDetails\UserDetailsController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/profile', [HeaderController::class, 'profile'])->name('profile')->middleware('auth');
Route::get('/orders', [HeaderController::class, 'orders'])->name('orders')->middleware('auth');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/user/name/update', [UserDetailsController::class, 'updateName'])->name('name.update');

Route::post('/address/{id}/update', [UserDetailsController::class, 'updateAddress'])->name('address.update');
Route::delete('/address/{id}/delete', [UserDetailsController::class, 'deleteAddress'])->name('address.delete');
Route::post('/address/store', [UserDetailsController::class, 'storeAddress'])->name('address.store');

Route::post('/card/{id}/update', [UserDetailsController::class, 'updateCard'])->name('card.update');
Route::delete('/card/{id}/delete', [UserDetailsController::class, 'deleteCard'])->name('card.delete');
Route::post('/card/store', [UserDetailsController::class, 'storeCard'])->name('card.store');


//DEBUG SESSION
Route::get('/debug-session', function () {
    return response()->json(session()->all());
});
