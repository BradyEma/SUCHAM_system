<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierRegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;

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
});

Route::resource('orders', OrderController::class);

Route::resource('suppliers', SupplierController::class);
Route::patch('/suppliers/{supplier}/approve', [SupplierController::class, 'approve'])->name('suppliers.approve');
Route::patch('/suppliers/{supplier}/reject', [SupplierController::class, 'reject'])->name('suppliers.reject');

require __DIR__.'/auth.php';
