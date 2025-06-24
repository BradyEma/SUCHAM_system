<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Chat;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierRegisterController;
use App\Http\Controllers\SupplierProfileController;
use App\Http\Controllers\RoleSelectionController;

Route::get('/', function () {
    return view('welcome');
});

// Login routes
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

// Supplier registration
Route::get('/register/supplier', [SupplierRegisterController::class, 'showRegistrationForm'])->name('register.supplier');
Route::post('/register/supplier', [SupplierRegisterController::class, 'register'])->name('register.supplier.submit');

Route::middleware(['auth'])->group(function () {
    // Dashboards
    Route::view('/supplier/dashboard', 'dashboard.supplier-dashboard')->name('supplier.dashboard');
    Route::view('/retailer/dashboard', 'dashboard.retailer-dashboard')->name('retailer.dashboard');
    Route::view('/wholesaler/dashboard', 'dashboard.wholesaler-dashboard')->name('wholesaler.dashboard');
    Route::view('/customer/dashboard', 'dashboard.customer-dashboard')->name('customer.dashboard');
    Route::view('/admin/dashboard', 'dashboard.admin')->name('admin.dashboard');
    Route::view('/dashboard', 'dashboard')->middleware(['verified'])->name('dashboard');

    // Role selection
    Route::get('/choose-role', [RoleSelectionController::class, 'index'])->name('choose.role');
    Route::post('/choose-role', [RoleSelectionController::class, 'store'])->name('choose.role.store');

    // Supplier pages
    Route::get('/supplier/profile', fn () => view('dashboard.supplier-profile'))->name('supplier.profile');
    Route::get('/supplier/orders', fn () => view('dashboard.supplier-orders'))->name('supplier.orders');
    Route::post('/supplier/profile/update-password', [SupplierProfileController::class, 'updatePassword'])->name('supplier.password.update');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Chat
    Route::get('/chat/{receiver_id?}', Chat::class)->name('chat');
    Route::get('/chat-contacts', fn () => view('chat.contacts'))->name('chat.contacts');
    
    // Reports
    Route::any('/reports', fn () => view('reports'))->name('reports');
});

// Optional: Supplier dashboard under separate guard (only if needed)
Route::get('/supplier/dashboard', fn () => view('dashboard.supplier'))->middleware('auth:supplier')->name('supplier.dashboard');

// Include additional auth routes
require __DIR__.'/auth.php';
