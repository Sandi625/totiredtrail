<?php

use App\Http\Controllers\AllTourController;
use App\Http\Controllers\AuthController;
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


/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/


Route::middleware('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::resource('tour', TourController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('blogs', BlogController::class);

    Route::resource('review', ReviewController::class)
        ->except(['show']);

    Route::resource('gallery', GalleryController::class);

});

/*
|--------------------------------------------------------------------------
| PUBLIC / USER
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/allpackage', [AllTourController::class, 'index'])
    ->name('allpackage.page');

Route::get('/tours/{slug}', [TourDetailController::class, 'show'])
    ->name('tour.detail');

Route::get('/tour/{tour}/booking', [BookingController::class, 'create'])
    ->name('tour.booking');

Route::post('/tour/{tour}/booking', [BookingController::class, 'store'])
    ->name('tour.booking.store');

Route::get('/userblog', [UserBlogController::class, 'index'])
    ->name('user.blog.index');

Route::get('/userblog/{slug}', [UserBlogController::class, 'show'])
    ->name('user.blog.show');

Route::prefix('galleries')->name('user.gallery.')->group(function () {
    Route::get('/images', [UserGalleryController::class, 'images'])
        ->name('images');

    Route::get('/videos', [UserGalleryController::class, 'videos'])
        ->name('videos');
});





/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');




