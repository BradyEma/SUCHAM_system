<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Chat;

use App\Http\Controllers\ChatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierRegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/supplier/orders', function () {
    return view('dashboard.supplier-orders');
})->middleware('auth:supplier')->name('supplier.orders');

Route::get('/supplier/profile', function () {
    return view('dashboard.supplier-profile');
})->middleware('auth:supplier')->name('supplier.profile');


Route::get('/login', function () {
    return view('auth.login'); // adjust this if your view is in a different location
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/chat/{receiver_id?}', Chat::class)->name('chat');
Route::get('/chat/{receiver_id?}', function ($receiver_id = null) {
    return view('chat', compact('receiver_id'));
})->middleware('auth')->name('chat');


Route::get('/chat-contacts', function () {
    return view('chat.contacts');
})->middleware('auth')->name('chat.contacts');


// Supplier-specific routes
Route::get('/supplier/dashboard', function () {
    return view('dashboard.supplier');
})->middleware('auth:supplier')->name('supplier.dashboard');

Route::get('/register/supplier', [SupplierRegisterController::class, 'showRegistrationForm'])->name('register.supplier');
Route::post('/register/supplier', [SupplierRegisterController::class, 'register'])->name('register.supplier.submit');

// General dashboard (web auth guard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin and Customer Dashboards
    Route::get('/admin/dashboard', fn () => view('dashboard.admin'))->name('admin.dashboard');
    Route::get('/customer/dashboard', fn () => view('dashboard.customer'))->name('customer.dashboard');
});
Route::any('/reports', function(){
return view ('reports');
});
require __DIR__.'/auth.php';
