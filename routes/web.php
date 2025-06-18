<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Chat;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/chat/{receiver_id}', Chat::class)->middleware('auth')->name('chat');

Route::get('/chat/{receiver_id}', [ChatController::class, 'index'])->name('chat');

Route::get('/chat-contacts', function () {
    return view('chat.contacts');
})->middleware('auth')->name('chat.contacts');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::any('/reports', function(){
return view ('reports');
});
require __DIR__.'/auth.php';
