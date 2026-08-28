<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\GeneratePdf;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('/', 'index')->name('index');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('users.dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/users/{User}/profile', [RegisteredUserController::class, 'show']);
    Route::patch('/users/{User}', [RegisteredUserController::class, 'update']);

    Route::get('/receipts/index', [ReceiptController::class, 'index'])->name('receipts.index');
    Route::get('/receipts/create', [ReceiptController::class, 'create']);
    Route::post('/receipts', [ReceiptController::class, 'store']);
    Route::get('/receipts/{receipt}/view', [ReceiptController::class, 'viewDetails'])->name('receipts.view_details');
    Route::get('/receipts/{receipt}/download', [GeneratePdf::class, 'download'])->name('pdf.receipt');
    
    Route::get('/tenants/index', [TenantController::class, 'index'])->name('tenants.index');
    Route::get('/tenants/create', [TenantController::class, 'create']);
    Route::post('/tenants', [TenantController::class, 'store']);
    Route::get('/tenants/{tenant}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
    Route::put('/tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');
    Route::delete('/tenants/{tenant}', [TenantController::class, 'destroy'])->name('tenants.delete');
    
    Route::get('/properties/index', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/create', [PropertyController::class, 'create']);
    Route::post('/properties', [PropertyController::class, 'store']);
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.delete');
});
