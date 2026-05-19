<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

// Публичные
Route::post('/guests', [GuestController::class, 'store']);
Route::get('/stats', [GuestController::class, 'stats']);

// Админские (проверка через сессию)
Route::get('/admin/guests', [GuestController::class, 'adminIndex']);
Route::delete('/admin/guests/{id}', [GuestController::class, 'destroy']);
Route::get('/admin/guests/export', [GuestController::class, 'export']);
