<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('categories/upload-image', [CategoryController::class, 'uploadImage'])->name('categories.storeMedia');
Route::resource('categories', CategoryController::class);

Route::post('subcategories/upload-image', [SubCategoryController::class, 'uploadImage'])->name('subcategories.storeMedia');
Route::resource('subcategories', SubCategoryController::class);

Route::post('products/upload-image', [ProductController::class, 'uploadImage'])->name('products.storeMedia');
Route::resource('products', ProductController::class);

