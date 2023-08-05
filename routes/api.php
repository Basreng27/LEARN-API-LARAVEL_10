<?php

use App\Http\Controllers\KomikController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/komik', [KomikController::class, 'index']);
