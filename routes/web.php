<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Applications;
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
Route::get('password/reset', [AdminController::class, 'reset'])->name('password.request');
Route::post('password/store', [AdminController::class, 'store'])->name('password.store');

//User Management
Route::resource('users', UserController::class)->except('index');
Route::get('circulars/show',function ()  {
    return "this is show method";
})->name('circulars.show');

Route::get('circulars/index',[PortalController::class, 'index'])->name('circulars.index');
Route::get('circulars/show/{id}',[PortalController::class,'show'])->name('circulars.show');

Route::middleware(['admin:user'])->group(function () {
    Route::post('/applications/store', [Applications::class, 'store'])->name('application.store');
    Route::get('applications',[Applications::class,'list'])->name('applications.list');     
});

Route::middleware(['admin:admin'])->group(function () {
    Route::get('applications/index', [Applications::class,'index'])->name('applications.index');
    Route::put('applications/update/{id}', [Applications::class,'update'])->name('applications.update');
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('users', UserController::class . '@index')->name('users.index');
    Route::delete('circulars/{id}', [PortalController::class, 'destroy'])->name('circulars.destroy');
    
    Route::get('circulars/create', [PortalController::class,'create'])->name('circulars.create');

    Route::post('circulars', [PortalController::class, 'store'])->name('circulars.store');
    Route::get('circulars/{id}/edit', [PortalController::class, 'edit'])->name('circulars.edit');
    Route::put('circulars/{id}', [PortalController::class, 'update'])->name('circulars.update');

});

