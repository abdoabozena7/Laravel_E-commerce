<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home route redirects to products index
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Authentication routes for guests
Route::middleware('guest')->group(function () {
    Route::get('/register', [LoginRegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginRegisterController::class, 'register'])->name('register.store');
    Route::get('/login', [LoginRegisterController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginRegisterController::class, 'login'])->name('login.perform');
});

// Protected routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

    // Resourceful routes
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'store']);
});