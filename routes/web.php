<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Trang chủ: ai cũng vào được
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Trang dashboard (nếu bạn vẫn muốn giữ)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Nhóm các route cần đăng nhập
Route::middleware(['auth'])->group(function () {
    // Quản lý đơn hàng, sản phẩm, khách hàng
    Route::resource('orders', OrderController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);

    // Quản lý tài khoản
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Xác thực đăng nhập, đăng ký (từ Laravel Breeze hoặc Fortify)
require __DIR__.'/auth.php';
