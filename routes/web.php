<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\MybookingController;
use App\Http\Controllers\ForgotPasswordContoller;

// Web
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\SiteController;


// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login_process'])->name('auth.login.process');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register_process'])->name('auth.register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// PROFILE
Route::prefix('profile')->middleware('auth:web')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/', [ProfileController::class, 'update'])->name('user.profile.update');
});

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/services', [SiteController::class, 'services'])->name('web.services');
Route::get('/service/{id}', [SiteController::class, 'service'])->name('web.service');


Route::get('/jasa', [JasaController::class, 'index']);
Route::get('/details', [DetailsController::class, 'index']);
Route::get('/mybooking', [MybookingController::class, 'index']);
Route::get('/forgot-pass', [ForgotPasswordContoller::class, 'forgotPass']);
Route::get('/forgot-pass-otp', [ForgotPasswordContoller::class, 'forgotPassOtp']);
