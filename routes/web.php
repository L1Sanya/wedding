<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

// Главная страница
Route::get('/', function () {
    return view('wedding');
});

// Админка
Route::get('/admin', [GuestController::class, 'admin']);
Route::post('/admin/login', [GuestController::class, 'adminLogin'])->name('admin.login');
Route::get('/admin/logout', [GuestController::class, 'adminLogout'])->name('admin.logout');
