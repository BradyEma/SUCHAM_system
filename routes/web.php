<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierRegisterController;
use App\Http\Controllers\SupplierProfileController;
use App\Http\Controllers\RoleSelectionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ChatController;
use App\Livewire\Admin\Messages\Messages;
use App\Livewire\Admin\Messages\ListConversation;
use App\Http\Controllers\SupportTicketController;

Route::get('/', fn () => view('welcome'));

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WholesalerController;
use App\Http\Controllers\Admin\CustomerSegmentController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CustomerController;


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
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::view('/admin/dashboard', 'dashboard.admin-dashboard')->name('admin.dashboard');
    Route::view('/dashboard', 'dashboard')->middleware(['verified'])->name('dashboard');
    
    // Chat routes
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{conversationId}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/start', [ChatController::class, 'startConversation'])->name('chat.start');
    Route::post('/chat/{conversationId}/message', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/search/users', [ChatController::class, 'searchUsers'])->name('chat.search.users');
    
    // Livewire chat page
    Route::get('/chat-livewire', [ChatController::class, 'livewire'])->name('chat.livewire');
    Route::get('/chat-test', [ChatController::class, 'test'])->name('chat.test');

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
    
    //wholesaler
    Route::get('/wholesaler/dashboard', [WholesalerController::class, 'dashboard'])->name('wholesaler.dashboard');
     Route::get('/wholesaler/profile', [WholesalerController::class, 'showProfileForm'])->name('wholesaler.profile');
    Route::post('/wholesaler/profile', [WholesalerController::class, 'storeProfile'])->name('wholesaler.profile.store');
    
    //customer
    Route::get('/customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
    Route::post('/customer/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
});

 Route::patch('/admin/suppliers/{id}/activate', [AdminController::class, 'activateSupplier'])->name('admin.suppliers.activate');
  Route::patch('/admin/suppliers/{id}/suspend', [AdminController::class, 'suspendSupplier'])->name('admin.suppliers.suspend');
  Route::patch('/admin/suppliers/{id}/deactivate', [AdminController::class, 'deactivateSupplier'])->name('admin.suppliers.deactivate');

Route::get('/admin/chat/supplier/{id}', [AdminController::class, 'chatWithSupplier'])->name('admin.chat.supplier');


// ML
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/customer-segments', [CustomerSegmentController::class, 'index'])->name('admin.customer.segments');
    });
//extra ML
    Route::post('/admin/refresh-segments', function () {
        Artisan::call('ml:run-customer-segmentation');
        return redirect()->back()->with('success', 'Segments refreshed!');
    })->middleware(['auth', 'role:admin'])->name('admin.refresh.segments');
// ML demand prediction forecasting
    Route::post('/admin/run-demand-prediction', function () {
        Artisan::call('ml:run-demand-prediction');
        return redirect()->back()->with('success', 'Demand forecast updated successfully.');
    })->middleware(['auth', 'role:admin'])->name('admin.run.demand');
//promo email button
    Route::post('/admin/send-promo/{cluster}', [CustomerSegmentController::class, 'sendPromotionToCluster'])
        ->middleware(['auth', 'role:admin'])
        ->name('admin.send.promo');

Route::post('/wishlist/add', [CustomerController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [CustomerController::class, 'getWishlist'])->name('wishlist.get');
//support center
Route::middleware(['auth'])->group(function () {
    Route::get('/support', [SupportTicketController::class, 'index'])->name('support.index');
    Route::get('/support/create', [SupportTicketController::class, 'create'])->name('support.create');
    Route::post('/support', [SupportTicketController::class, 'store'])->name('support.store');

    // Admin-only
    Route::post('/support/{ticket}/reply', [SupportTicketController::class, 'reply'])->middleware('can:isAdmin')->name('support.reply');

    // UI improved placeholder
    Route::get('/support/{ticket}', [SupportTicketController::class, 'show'])->name('support.show');
    Route::post('/support/{ticket}/reply', [SupportTicketController::class, 'storeReply'])->name('support.reply.store');
    
    Route::patch('/support/{ticket}/status', [SupportTicketController::class, 'updateStatus'])
        ->name('support.updateStatus');

});
// reexamine this section
// Route::middleware(['auth'])->group(function () {
//     Route::get('/support', [SupportTicketController::class, 'index'])->name('support.index');
//     Route::get('/support/create', [SupportTicketController::class, 'create'])->name('support.create');
//     Route::post('/support', [SupportTicketController::class, 'store'])->name('support.store');
//     Route::post('/support/{ticket}/reply', [SupportTicketController::class, 'reply'])->name('support.reply');
// });


// Auth routes
Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
// Supplier registration
Route::post('/register/supplier', [SupplierRegisterController::class, 'register'])->name('register.supplier.submit');

require __DIR__.'/auth.php';
