<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BidController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', function () {
    // Handle form submission here
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Bidding routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cars/{car}/bid', [BidController::class, 'create'])->name('bids.create');
    Route::post('/bids', [BidController::class, 'store'])->name('bids.store');
    Route::get('/bids', [BidController::class, 'index'])->name('bids.index');
    Route::patch('/bids/{bid}', [BidController::class, 'update'])->name('bids.update');
});

require __DIR__.'/auth.php';
