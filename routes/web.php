<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PriceEntryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Appointments routes
    Route::resource('appointments', AppointmentController::class);
    Route::post('/appointments/{appointment_id}/reminded', [AppointmentController::class, 'markReminded'])->name('appointments.markReminded');
    Route::get('/dismiss-reminder', [AppointmentController::class, 'dismissReminder'])->name('appointments.dismissReminder');
    
    // Suppliers routes
    Route::resource('suppliers', SupplierController::class);
    
    // Products routes
    Route::resource('products', ProductController::class);
    
    // Price entries routes
    Route::resource('price-entries', PriceEntryController::class);
    Route::get('price-entries-compare', [PriceEntryController::class, 'compare'])->name('price-entries.compare');

    // Dashboard chart data route
    Route::get('dashboard/price-comparison-chart-data', [\App\Http\Controllers\DashboardController::class, 'priceComparisonChartData'])->name('dashboard.priceComparisonChartData');
});

require __DIR__.'/auth.php';
