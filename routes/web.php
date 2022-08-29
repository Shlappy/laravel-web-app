<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.index');
});

Route::get('catalog', [CategoryController::class, 'index'])->name('catalog');

Route::controller(ProductController::class)->group(function () {
    Route::get('products/{category:slug}', 'index')->name('products');
    Route::post('products/{category:slug}', 'applyFilters');
    Route::get('product/{product:slug}', 'show')->name('products.show');
});

Route::controller(CartController::class)->name('cart.')->group(function () {
    Route::get('cart', 'index')->name('list');
    Route::post('cart', 'store')->name('store');
    Route::post('update-cart', 'update')->name('update');
    Route::post('cart-remove', 'remove')->name('remove');
    Route::post('cart-clear', 'clear')->name('clear');
});

Route::get('user/{user:id}', [UserController::class, 'show'])->name('account');

require __DIR__ . '/auth.php';
