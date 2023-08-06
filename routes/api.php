<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::get('/komik', [KomikController::class, 'index'])->middleware(['auth:sanctum']); //sanctum fungsinya cek apakah user login atau belum
Route::get('/komik/{id}', [KomikController::class, 'detail'])->middleware(['auth:sanctum']);

Route::get('/logged', [AuthController::class, 'logged'])->middleware(['auth:sanctum']);
