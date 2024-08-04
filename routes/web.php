<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('watermelon/bulk', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'bulk'])->name('watermelon/bulk')->middleware('auth');
Route::post('watermelon/subcategory', [\App\Http\Controllers\Watermelon\WatermelonController::class, 'subcategory'])->name('watermelon/subcategory')->middleware('auth');
Route::post('category/bulk', [\App\Http\Controllers\Category\CategoryController::class, 'bulk'])->name('category/bulk')->middleware('auth');
Route::resource('watermelon', \App\Http\Controllers\Watermelon\WatermelonController::class)->middleware('auth');
Route::resource('category', \App\Http\Controllers\Category\CategoryController::class)->middleware('auth');
Route::get('/dashboard', function (){})->middleware('auth');
Route::get('/weather', [\App\Http\Controllers\Weather\WeatherController::class, 'index'])->middleware('auth');
Route::post('/weather/city', [\App\Http\Controllers\Weather\WeatherController::class, 'getWatherByCity'])->middleware('auth');

