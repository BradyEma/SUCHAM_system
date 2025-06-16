<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard routes
    Route::get('/admin/dashboard', fn () => view('dashboard.admin'))->name('admin.dashboard');
    Route::get('/supplier/dashboard', fn () => view('dashboard.supplier'))->name('supplier.dashboard');
    Route::get('/customer/dashboard', fn () => view('dashboard.customer'))->name('customer.dashboard');
});
require __DIR__.'/auth.php';
