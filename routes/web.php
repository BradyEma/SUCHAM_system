<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierRegisterController;
use App\Http\Controllers\InventoryController;

/*
|--------------------------------------------------------------------------
| Public Routes (no auth required)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

// Direct access to inventory.create Blade view
Route::get('/inventory/create', function () {
    return view('inventory.create');
});

// Direct access to other inventory views if needed (optional)
// Route::get('/inventory', function () {
//     return view('inventory.index');
// });

Route::get('/supplier/orders', function () {
    return view('dashboard.supplier-orders');
})->name('supplier.orders');

Route::get('/supplier/profile', function () {
    return view('dashboard.supplier-profile');
})->name('supplier.profile');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/register/supplier', [SupplierRegisterController::class, 'showRegistrationForm'])->name('register.supplier');
Route::post('/register/supplier', [SupplierRegisterController::class, 'register'])->name('register.supplier.submit');

/*
|--------------------------------------------------------------------------
| Authenticated Routes (requires login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Shared user dashboards
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/admin/dashboard', fn () => view('dashboard.admin'))->name('admin.dashboard');
    Route::get('/customer/dashboard', fn () => view('dashboard.customer'))->name('customer.dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inventory controller routes (require auth)
    Route::resource('/inventory', InventoryController::class)->except(['create']);
    Route::get('/inventory-pdf', [InventoryController::class, 'exportPDF'])->name('inventory.pdf');
});

// Supplier-only dashboard (optional separate auth guard)
Route::get('/supplier/dashboard', function () {
    return view('dashboard.supplier');
})->middleware('auth:supplier')->name('supplier.dashboard');

require __DIR__.'/auth.php';
