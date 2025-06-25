<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierRegisterController;
use App\Http\Controllers\SupplierProfileController;
use App\Http\Controllers\RoleSelectionController;
use App\Http\Controllers\InventoryController;

// Home page
Route::get('/', fn () => view('welcome'))->name('home');

// Auth routes
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Supplier registration
Route::post('/register/supplier', [SupplierRegisterController::class, 'register'])->name('register.supplier.submit');

// Authenticated routes
Route::middleware(['auth'])->group(function () {

    // Dashboards
    Route::view('/dashboard', 'dashboard')->middleware(['verified'])->name('dashboard');
    Route::view('/admin/dashboard', 'dashboard.admin')->name('admin.dashboard');
    Route::view('/customer/dashboard', 'dashboard.customer-dashboard')->name('customer.dashboard');
    Route::view('/retailer/dashboard', 'dashboard.retailer-dashboard')->name('retailer.dashboard');
    Route::view('/wholesaler/dashboard', 'dashboard.wholesaler-dashboard')->name('wholesaler.dashboard');

    // Role selection
    Route::get('/choose-role', [RoleSelectionController::class, 'index'])->name('choose.role');
    Route::post('/choose-role', [RoleSelectionController::class, 'store'])->name('choose.role.store');

    // Supplier pages
    Route::view('/supplier/profile', 'dashboard.supplier-profile')->name('supplier.profile');
    Route::view('/supplier/orders', 'dashboard.supplier-orders')->name('supplier.orders');
    Route::view('/supplier/products', 'dashboard.supplier-products')->name('supplier.products');
    Route::view('/supplier/settings', 'dashboard.supplier-settings')->name('supplier.settings');
    Route::post('/supplier/profile/update-password', [SupplierProfileController::class, 'updatePassword'])->name('supplier.password.update');

    // User profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inventory
    Route::resource('/inventory', InventoryController::class)->except(['create']);
    Route::get('/inventory/create', fn () => view('inventory.create'));
    Route::get('/inventory-pdf', [InventoryController::class, 'exportPDF'])->name('inventory.pdf');
});

// Additional auth routes from Laravel Breeze or Jetstream
require __DIR__.'/auth.php';
