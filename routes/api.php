<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Dashboard API routes without rate limiting
Route::middleware(['api'])->group(function () {
    Route::post('/bookings', [\App\Http\Controllers\AdminController::class, 'storeBookingRequest']);
    Route::get('/cottages/{id}/unavailable-dates', [\App\Http\Controllers\AdminController::class, 'getUnavailableDates']);
    Route::get('/cottages/{id}/blocked-dates', [\App\Http\Controllers\AdminController::class, 'getBlockedDates']);
    Route::post('/blocked-dates', [\App\Http\Controllers\AdminController::class, 'addBlockedDate']);
    Route::delete('/blocked-dates/{cottage}/{date}', [\App\Http\Controllers\AdminController::class, 'removeBlockedDate']);
    Route::get('/cottages/{id}/special-prices', [\App\Http\Controllers\AdminController::class, 'getSpecialPrices']);
    Route::post('/special-prices', [\App\Http\Controllers\AdminController::class, 'addSpecialPrice']);
    Route::delete('/special-prices/{cottage}/{date}', [\App\Http\Controllers\AdminController::class, 'removeSpecialPrice']);
});
