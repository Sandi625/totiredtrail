<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourDetailController;
use App\Http\Controllers\UserBlogController;
use App\Http\Controllers\UserGalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
//user
Route::get('/tour/{slug}', [TourDetailController::class, 'show'])
    ->name('tour.detail');

    Route::get('/tour/{tour}/booking', [BookingController::class, 'create'])->name('tour.booking');
Route::post('/tour/{tour}/booking', [BookingController::class, 'store'])->name('tour.booking.store');

//admin
Route::resource('tour', TourController::class);

Route::resource('categories', CategoryController::class);

Route::resource('blogs', BlogController::class);

Route::resource('review', ReviewController::class)->except(['show']);

Route::resource('gallery', GalleryController::class);




//user
Route::get('/userblog', [UserBlogController::class, 'index'])->name('user.blog.index');
Route::get('/userblog/{slug}', [UserBlogController::class, 'show'])->name('user.blog.show');


Route::prefix('galleries')->name('user.gallery.')->group(function () {

    // halaman gambar
    Route::get('/images', [UserGalleryController::class, 'images'])->name('images');

    // halaman video
    Route::get('/videos', [UserGalleryController::class, 'videos'])->name('videos');

});


