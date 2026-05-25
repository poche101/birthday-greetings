<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WishController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MediaController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $mediaItems = \App\Models\Media::latest()->get();
    return view('welcome', compact('mediaItems'));
})->name('home');

Route::post('/media/upload', [MediaController::class, 'store'])->name('media.upload');
Route::post('/wishes', [WishController::class, 'store'])->name('wishes.store');
Route::post('/media/upload', [MediaController::class, 'store'])->name('media.upload');
/*
|--------------------------------------------------------------------------
| AUTH ROUTES (for guests / login)
|--------------------------------------------------------------------------
*/

// Add this default login route if needed by middleware or forms
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::patch('/wishes/{wish}/feature', [DashboardController::class, 'toggleFeature'])->name('wishes.feature');
        Route::delete('/wishes/{wish}', [DashboardController::class, 'destroy'])->name('wishes.destroy');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
