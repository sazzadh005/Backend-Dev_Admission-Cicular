<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortalController;
use App\Models\Portal;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('login', function () {
    return view('auth.login');
})->name('login');


Route::post('login', [AdminController::class, 'login']);
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/', [PortalController::class, 'index']);

//User Management
Route::resource('users', UserController::class)->except('index');
Route::resource('circulars', PortalController::class)->except('destroy');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('users', UserController::class . '@index')->name('users.index');
    Route::delete('circulars/{id}', [PortalController::class, 'destroy'])->name('circulars.destroy');

});

