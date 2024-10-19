<?php

use App\Http\Controllers\Facebook\FacebookController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('watermelon/bulk', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'bulk'])->name('watermelon/bulk')->middleware('auth');
Route::post('product/bulk', [\App\Http\Controllers\Product\ProductController::class, 'bulk'])->name('product/bulk')->middleware('auth');
Route::post('watermelon/subcategory', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'subcategory'])->name('watermelon/subcategory')->middleware('auth');
Route::post('product/subcategory', [\App\Http\Controllers\Product\ProductController::class, 'subcategory'])->name('product/subcategory')->middleware('auth');
Route::post('category/bulk', [\App\Http\Controllers\Category\CategoryController::class, 'bulk'])->name('category/bulk')->middleware('auth');
Route::get('category/{category}/item', [\App\Http\Controllers\Category\CategoryController::class, 'item'])->name('category/item')->middleware('auth');
//Route::resource('watermelon', \App\Http\Controllers\Watermelon\WatermelonController::class)->middleware('auth');
Route::resource('product', \App\Http\Controllers\Product\ProductController::class)->middleware('auth');
Route::resource('category', \App\Http\Controllers\Category\CategoryController::class)->middleware('auth');


Route::get('/watermelon', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'index'])->name('watermelon.index');
Route::get('/watermelon/{id}', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'show'])->name('watermelon.show');
Route::get('/watermelon/create', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'create'])->name('watermelon.create');
Route::post('/watermelon', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'store'])->name('watermelon.store');
Route::get('/watermelon/{id}/edit', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'edit'])->name('watermelon.edit');
Route::put('/watermelon/{id}', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'update'])->name('watermelon.update');
Route::delete('/watermelon/{id}', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'destroy'])->name('watermelon.destroy');
Route::get('/dashboard', function (){})->middleware('auth');

Route::get('/auth/facebook', [FacebookController::class, 'redirect'])->name('facebook.redirect');
Route::get('/auth/facebook/callback', [FacebookController::class, 'handleCallback'])->name('facebook.callback');
Route::get('/facebook/posts', [FacebookController::class, 'showPosts'])->name('facebook.posts');
Route::get('/facebook/post-create', [FacebookController::class, 'createPost'])->name('facebook.postCreate');
Route::get('/facebook/photos-create', [FacebookController::class, 'createPhotos'])->name('facebook.photoCreate');
Route::post('/facebook/post', [FacebookController::class, 'storePost'])->name('facebook.publishPost');
