<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierRegisterController;
use App\Http\Controllers\SupplierProfileController;
use App\Http\Controllers\RoleSelectionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AdminController;


Route::get('/', fn () => view('welcome'));

Route::middleware(['auth', 'supplier.complete'])->group(function () {
    Route::view('/supplier/dashboard', 'dashboard.supplier-dashboard')->name('supplier.dashboard');
    // other protected supplier routes
});
  
Route::get('/admin/suppliers/{id}', [AdminController::class, 'showSupplier'])->name('admin.suppliers.show');

 
  
Route::middleware(['auth'])->group(function () {
    // Dashboards
    Route::get('/supplier/dashboard', [SupplierController::class, 'showDashboard'])->name('supplier.dashboard');

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
    Route::get('/supplier/products', fn () => view('dashboard.supplier-products'))->name('supplier.products');
    Route::get('/supplier/settings', fn () => view('dashboard.supplier-settings'))->name('supplier.settings');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

  
  


    // User profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //suppliers-profile form
    Route::get('/supplier/profile-form', [SupplierController::class, 'showProfileForm'])->name('supplier.profile.form');
    Route::post('/supplier/profile-form', [SupplierController::class, 'storeProfile'])->name('supplier.profile.store');
    Route::post('/supplier/profile/update', [SupplierProfileController::class, 'update'])->name('supplier.profile.update');
    

});

 Route::patch('/admin/suppliers/{id}/activate', [AdminController::class, 'activateSupplier'])->name('admin.suppliers.activate');
  Route::patch('/admin/suppliers/{id}/suspend', [AdminController::class, 'suspendSupplier'])->name('admin.suppliers.suspend');
  Route::patch('/admin/suppliers/{id}/deactivate', [AdminController::class, 'deactivateSupplier'])->name('admin.suppliers.deactivate');

Route::get('/admin/chat/supplier/{id}', [AdminController::class, 'chatWithSupplier'])->name('admin.chat.supplier');

// Auth routes
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
// Supplier registration
Route::post('/register/supplier', [SupplierRegisterController::class, 'register'])->name('register.supplier.submit');

require __DIR__.'/auth.php';
