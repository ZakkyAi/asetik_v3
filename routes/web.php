<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RepairController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (all authenticated users)
Route::middleware('auth')->group(function () {
    // Dashboard - different for admin vs normal user
    Route::get('/dashboard', function () {
        if (auth()->user()->level === 'admin') {
            return view('dashboard');
        } else {
            return view('dashboard-user');
        }
    })->name('dashboard');
});

// Admin-only routes (create, edit, delete) - MUST come BEFORE dynamic routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Users - CREATE and EDIT routes
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Products - CREATE and EDIT routes
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // Records - CREATE and EDIT routes
    Route::get('records/create', [RecordController::class, 'create'])->name('records.create');
    Route::post('records', [RecordController::class, 'store'])->name('records.store');
    Route::get('records/{record}/edit', [RecordController::class, 'edit'])->name('records.edit');
    Route::put('records/{record}', [RecordController::class, 'update'])->name('records.update');
    Route::delete('records/{record}', [RecordController::class, 'destroy'])->name('records.destroy');
    
    // Repairs - CREATE and EDIT routes
    Route::get('repairs/create', [RepairController::class, 'create'])->name('repairs.create');
    Route::post('repairs', [RepairController::class, 'store'])->name('repairs.store');
    Route::get('repairs/{repair}/edit', [RepairController::class, 'edit'])->name('repairs.edit');
    Route::put('repairs/{repair}', [RepairController::class, 'update'])->name('repairs.update');
    Route::delete('repairs/{repair}', [RepairController::class, 'destroy'])->name('repairs.destroy');
});

// View routes for all authenticated users (index and show) - AFTER specific routes
Route::middleware('auth')->group(function () {
    // Users routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    
    // Products routes
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    
    // Records routes
    Route::get('records', [RecordController::class, 'index'])->name('records.index');
    Route::get('records/{record}', [RecordController::class, 'show'])->name('records.show');
    
    // Repairs routes
    Route::get('repairs', [RepairController::class, 'index'])->name('repairs.index');
    Route::get('repairs/{repair}', [RepairController::class, 'show'])->name('repairs.show');
});
