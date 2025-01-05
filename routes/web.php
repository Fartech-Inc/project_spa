<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::get('/register', [RegisterController::class, 'index']);
Route::get('/jasa', [JasaController::class, 'index']);
Route::get('/details', [DetailsController::class, 'index']);
Route::get('/profile', [ProfileController::class, 'index']);