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
    Route::get('products/list/{category:slug}', 'list')->name('products.list');
    Route::post('products/{category:slug}', 'applyFilters');
    Route::get('product/{product:slug}', 'show')->name('products.show');
});

Route::controller(CartController::class)->name('cart.')->group(function () {
    Route::get('cart', 'index')->name('index');
    Route::post('cart', 'store')->name('store');
    Route::get('cart-list', 'list')->name('list');
    Route::post('update-cart', 'update')->name('update');
    Route::post('cart-remove', 'remove')->name('remove');
    Route::post('cart-clear', 'clear')->name('clear');
});

Route::get('user/{user:id}', [UserController::class, 'show'])->name('account');

require __DIR__ . '/auth.php';
