<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// OPD Routes
Route::middleware(['auth', 'role:opd'])->prefix('opd')->name('opd.')->group(function () {
    Route::get('/dashboard', [OpdController::class, 'dashboard'])->name('dashboard');
    Route::get('/riwayat', [OpdController::class, 'history'])->name('history');
    Route::post('/surat/bulk-delete', [OpdController::class, 'bulkDelete'])->name('surat.bulk-delete');
    Route::get('/surat/create', [OpdController::class, 'create'])->name('surat.create');
    Route::post('/surat', [OpdController::class, 'store'])->name('surat.store');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/riwayat', [AdminController::class, 'history'])->name('history');
    Route::post('/surat/bulk-delete', [AdminController::class, 'bulkDelete'])->name('surat.bulk-delete');
    Route::get('/surat/{surat}', [AdminController::class, 'show'])->name('surat.show');
    Route::get('/surat/{surat}/print', [AdminController::class, 'print'])->name('surat.print');
    Route::patch('/surat/{surat}/status', [AdminController::class, 'updateStatus'])->name('surat.update-status');
});

// Shared Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});
