<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CottageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [CottageController::class, 'index'])->name('cottage.index');
Route::get('/cottage/{id}', [CottageController::class, 'show'])->name('cottage.show');
Route::get('language/{locale}', [LanguageController::class, 'switchLang'])->name('language.switch');

// Booking and Review Routes
Route::post('/bookings', [AdminController::class, 'storeBookingRequest'])->name('bookings.store');
Route::post('/reviews', [AdminController::class, 'storeReview'])->name('reviews.store');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/cottages', [AdminController::class, 'getCottages'])->name('admin.cottages');
    Route::post('/cottages', [AdminController::class, 'storeCottage'])->name('admin.cottages.store');
    Route::put('/cottages/{id}', [AdminController::class, 'updateCottage'])->name('admin.cottages.update');
    Route::delete('/cottages/{id}', [AdminController::class, 'deleteCottage'])->name('admin.cottages.delete');
    
    // Gallery routes
    Route::post('/gallery/upload', [AdminController::class, 'uploadGalleryImages'])->name('admin.gallery.upload');
    Route::delete('/gallery/delete/{filename}', [AdminController::class, 'deleteGalleryImage'])->name('admin.gallery.delete');
    
    // Video routes
    Route::post('/videos/upload', [AdminController::class, 'uploadVideo'])->name('admin.videos.upload');
    Route::delete('/videos/delete/{filename}', [AdminController::class, 'deleteVideo'])->name('admin.videos.delete');
    
    // Hero image routes
    Route::post('/hero-image/upload', [AdminController::class, 'uploadHeroImage'])->name('admin.hero-image.upload');
    Route::delete('/hero-image/delete/{filename}', [AdminController::class, 'deleteHeroImage'])->name('admin.hero-image.delete');
    
    // Hero video routes
    Route::post('/hero-video/upload', [AdminController::class, 'uploadHeroVideo'])->name('admin.hero-video.upload');
    Route::delete('/hero-video/delete/{filename}', [AdminController::class, 'deleteHeroVideo'])->name('admin.hero-video.delete');
    
    // Stats route
    Route::get('/stats', [AdminController::class, 'getStats'])->name('admin.stats');
    
    // Customer routes
    Route::delete('/customers/{id}', [AdminController::class, 'deleteCustomer'])->name('admin.customers.delete');
    // Review routes
    Route::delete('/reviews/{id}', [AdminController::class, 'deleteReview'])->name('admin.reviews.delete');
});

// API Routes (accessible from /api/ prefix)
Route::prefix('api')->group(function () {
    Route::get('/cottages', [AdminController::class, 'getCottages']);
    Route::get('/cottages/{id}', [AdminController::class, 'getCottage']);
    Route::post('/cottages', [AdminController::class, 'createCottage']);
    Route::match(['post', 'put'], '/cottages/{id}', [AdminController::class, 'updateCottage']);
    Route::delete('/cottages/{id}', [AdminController::class, 'deleteCottage']);
    Route::post('/upload-image', [AdminController::class, 'uploadImage']);
    Route::get('/stats', [AdminController::class, 'getStats']);
});
