<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () { //sanctum fungsinya cek apakah user login atau belum
    Route::get('/logged', [AuthController::class, 'logged']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/komik', [KomikController::class, 'index']);
    Route::get('/komik/{id}', [KomikController::class, 'show']);
    Route::post('/komik', [KomikController::class, 'store']);
    Route::patch('/komik/{id}', [KomikController::class, 'update']);
    Route::delete('/komik/{id}', [KomikController::class, 'destroy']);
});


// PUT: Metode PUT digunakan untuk mengganti seluruh entitas atau data pada server dengan data yang baru.
//     Jika Anda menggunakan PUT untuk mengirimkan permintaan perubahan data, Anda harus menyertakan semua atribut dari entitas tersebut,
//     bahkan jika ada atribut yang tidak mengalami perubahan.
//     $requestData = [
//         'name' => 'John Doe',
//         'email' => 'john@example.com',
//         'age' => 30,
//     ];

// PATCH: Metode PATCH digunakan untuk memperbarui sebagian atribut dari entitas atau data pada server.
//     Dengan menggunakan PATCH, Anda hanya perlu mengirimkan atribut-atribut yang ingin diperbarui tanpa harus menyertakan seluruh atribut.
//     Sehingga, metode PATCH lebih cocok digunakan ketika Anda ingin melakukan perubahan hanya pada beberapa bagian data tanpa mengganti seluruh entitas.
//     $requestData = [
//         'email' => 'john@example.com',
//     ];
