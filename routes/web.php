<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ToursController;
use App\Http\Controllers\GalleryController;

Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/tour/{slug}', [IndexController::class, 'tour'])->name('tour');
Route::get('/chi-tiet-tour/{slug}', [IndexController::class, 'detail_tour'])->name('chi-tiet-tour');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Categories
Route::resource('categories', CategoriesController::class);

//Tour
Route::resource('tours', ToursController::class);
//Gallery
Route::resource('gallery', GalleryController::class);