<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LoanCalculatorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::resource('cars', CarController::class);

Route::resource('blogs', BlogController::class);

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

// Loan Calculator routes
Route::get('/loan-calculator', [LoanCalculatorController::class, 'index'])->name('loan.calculator');
Route::post('/loan-calculator/calculate', [LoanCalculatorController::class, 'calculate'])->name('loan.calculate');

Route::middleware(['auth'])->group(function () {
    Route::post('/cars/{car}/contact', [ContactController::class, 'contactSeller'])->name('cars.contact');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Cars Management
    Route::get('/cars/sale', [CarController::class, 'adminSaleIndex'])->name('cars.sale');
    Route::get('/cars/auction', [CarController::class, 'adminAuctionIndex'])->name('cars.auction');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::patch('/cars/{car}/toggle-featured', [CarController::class, 'toggleFeatured'])->name('cars.toggle-featured');

    // Bids Management
    Route::get('/bids', [BidController::class, 'index'])->name('bids.index');
    Route::get('/bids/{bid}', [BidController::class, 'show'])->name('bids.show');
    Route::put('/bids/{bid}/approve', [BidController::class, 'approve'])->name('bids.approve');
    Route::put('/bids/{bid}/reject', [BidController::class, 'reject'])->name('bids.reject');
    Route::delete('/bids/{bid}', [BidController::class, 'destroy'])->name('bids.destroy');

    // Users Management
    Route::resource('users', UserController::class);
    
    // Inquiries Management
    Route::resource('inquiries', InquiryController::class);
    
    // Admin Settings Routes
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
