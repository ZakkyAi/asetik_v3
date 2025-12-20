<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\RepairController;

// Public routes
Route::get('/', function () {
    return redirect('/login');
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
            return view('admin.dashboard');
        } else {
            return view('user.dashboard');
        }
    })->name('dashboard');
});

// ============================================
// ADMIN ROUTES - Full CRUD access
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Users Management
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Products Management
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // Records Management (Assign items to users)
    Route::get('records', [RecordController::class, 'index'])->name('records.index');
    Route::get('records/create', [RecordController::class, 'create'])->name('records.create');
    Route::post('records', [RecordController::class, 'store'])->name('records.store');
    Route::get('records/{record}', [RecordController::class, 'show'])->name('records.show');
    Route::get('records/{record}/edit', [RecordController::class, 'edit'])->name('records.edit');
    Route::put('records/{record}', [RecordController::class, 'update'])->name('records.update');
    Route::delete('records/{record}', [RecordController::class, 'destroy'])->name('records.destroy');
    
    // Repairs Management (Approve/Manage repairs)
    Route::get('repairs', [RepairController::class, 'index'])->name('repairs.index');
    Route::get('repairs/{repair}', [RepairController::class, 'show'])->name('repairs.show');
    Route::get('repairs/{repair}/edit', [RepairController::class, 'edit'])->name('repairs.edit');
    Route::put('repairs/{repair}', [RepairController::class, 'update'])->name('repairs.update');
    Route::delete('repairs/{repair}', [RepairController::class, 'destroy'])->name('repairs.destroy');
    
    // Repair Actions
    Route::post('repairs/{repair}/accept', [RepairController::class, 'accept'])->name('repairs.accept');
    Route::post('repairs/{repair}/decline', [RepairController::class, 'decline'])->name('repairs.decline');
    Route::post('repairs/{repair}/done', [RepairController::class, 'done'])->name('repairs.done');
});

// ============================================
// NORMAL USER ROUTES - Limited access
// ============================================
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    
    // Profile & Data
    Route::get('profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile');
    Route::get('profile/change-password', [App\Http\Controllers\User\ProfileController::class, 'editPassword'])->name('profile.change-password');
    Route::post('profile/change-password', [App\Http\Controllers\User\ProfileController::class, 'updatePassword'])->name('profile.update-password');
    
    // Repair Requests
    Route::get('repair/apply', [App\Http\Controllers\User\RepairController::class, 'applyIndex'])->name('repair.apply');
    Route::post('repair/apply', [App\Http\Controllers\User\RepairController::class, 'applyStore'])->name('repair.apply.store');
    Route::get('repair/pickup', [App\Http\Controllers\User\RepairController::class, 'pickupIndex'])->name('repair.pickup');
});
