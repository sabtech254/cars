<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BiddingController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');

// Add these routes with your existing routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/cars', [CarController::class, 'adminIndex'])->name('admin.cars.index');
    Route::get('/admin/cars/create', [CarController::class, 'create'])->name('admin.cars.create');
    Route::post('/admin/cars', [CarController::class, 'store'])->name('admin.cars.store');
    Route::get('/admin/cars/{car}/edit', [CarController::class, 'edit'])->name('admin.cars.edit');
    Route::put('/admin/cars/{car}', [CarController::class, 'update'])->name('admin.cars.update');
    Route::delete('/admin/cars/{car}', [CarController::class, 'destroy'])->name('admin.cars.destroy');
});

// Protected bidding routes
Route::middleware(['auth', 'bidding'])->group(function () {
    Route::get('/bidding', [BiddingController::class, 'index'])->name('bidding.index');
    Route::post('/bidding/place', [BiddingController::class, 'placeBid'])->name('bidding.place');
});

// Authentication routes (provided by Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';