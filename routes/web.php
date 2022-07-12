<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('pages.index');
});

Route::get('catalog', [CategoryController::class, 'index'])->name('catalog');

Route::controller(ProductController::class)->group(function () {
    Route::get('products/{category:slug}', 'index')->name('products');
    Route::post('products/{category:slug}', 'getProducts');
    Route::get('product/{product:slug}', 'show')->name('products.show');
});

Route::controller(CartController::class)->group(function () {
    Route::get('cart', 'index')->name('cart.list');
    Route::post('cart', 'addToCart')->name('cart.store');
    Route::patch('update-cart', 'updateCart')->name('cart.update');
    Route::post('remove', 'removeCart')->name('cart.remove');
    Route::post('clear-cart', 'clearAllCart')->name('cart.clear');
});

Route::get('user/{user:id}', [UserController::class, 'show'])->name('account');

// Admin routes
// Route::prefix('admin')->group(function () {
//   Route::controller(CategoryController::class)->group(function () {
//     Route::get('/', 'show')->name('category.show');
//     Route::post('/', 'store')->name('category.create');
//   });

//   Route::post('/products/{product}', 'ProductController@create')->name('product.create');
// });

require __DIR__ . '/auth.php';
