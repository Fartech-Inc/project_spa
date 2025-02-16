<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\DetailsController;

// Web
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\SiteController;
use App\Http\Controllers\MybookingController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\ForgotPasswordContoller;


// AUTH
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login_process'])->name('auth.login.process');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register_process'])->name('auth.register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// SITE
Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/services', [SiteController::class, 'services'])->name('web.services');
Route::get('/service/{id}', [SiteController::class, 'service'])->name('web.service');

// NEED TO LOGIN
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/booking/{id}', [SiteController::class, 'booking_page'])->name('web.booking.page');
    Route::post('/booking', [SiteController::class, 'booking_process'])->name('web.booking.process');
    Route::get('/payment/{transaction}', [SiteController::class, 'payment_process'])->name('web.payment.process');
    Route::get('/success/{id}', [SiteController::class, 'booking_success'])->name('web.booking.success');
    Route::get('/failed', [SiteController::class, 'booking_failed'])->name('web.booking.failed');
    Route::post('/testimonial/{id}', [SiteController::class, 'store_testimonial'])->name('web.store.testimonial');

    // PROFILE
    Route::prefix('profile')->middleware('auth:web')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('user.profile');
        Route::post('/', [ProfileController::class, 'update'])->name('user.profile.update');
        Route::get('/my-transactions', [ProfileController::class, 'my_transations'])->name('user.profile.my_transactions');
        Route::post('/cancel-transaction/{id}', [ProfileController::class, 'cancel_transaction'])->name('user.profile.cancel_transaction');
    });
});

Route::get('/mybooking', [MybookingController::class, 'index']);
Route::get('/forgot-pass', [ForgotPasswordContoller::class, 'forgotPass']);
Route::get('/forgot-pass-otp', [ForgotPasswordContoller::class, 'forgotPassOtp'])->name('auth.forgotPassOtp');
// Route untuk mengirim OTP
Route::post('/forgot-password/send-otp', [ForgotPasswordContoller::class, 'sendOtp'])->name('auth.sendOtp');
Route::post('/forgot-password/verify-otp', [ForgotPasswordContoller::class, 'verifyOtp'])->name('auth.verifyOtp');

Route::get('/new-password', [ForgotPasswordContoller::class, 'newPasswordForm'])->name('auth.resetPasswordForm');
Route::post('/new-password', [ForgotPasswordContoller::class, 'newPassword'])->name('auth.resetPassword');
