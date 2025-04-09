<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::resource('/', HomeController::class);

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
