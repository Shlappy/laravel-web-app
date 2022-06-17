<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

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

// Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('products.show');
Route::get('/catalog', 'App\Http\Controllers\CategoryController@index')->name('catalog');
Route::get('/{category}', 'App\Http\Controllers\CategoryController@show')->name('category');


// Admin routes
// Route::prefix('admin')->group(function () {
//   Route::controller(CategoryController::class)->group(function () {
//     Route::get('/', 'show')->name('category.show');
//     Route::post('/', 'store')->name('category.create');
//   });

//   Route::post('/products/{product}', 'App\Http\Controllers\ProductController@create')->name('product.create');
// });

require __DIR__ . '/auth.php';
