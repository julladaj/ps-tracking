<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

// Authentication  Route
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthenticationController::class, 'loginPage'])->name('auth-login');
    Route::post('login', [AuthenticationController::class, 'login'])->name('post-login');
    Route::get('register', [AuthenticationController::class, 'registerPage'])->name('auth-register');
    Route::post('register', [AuthenticationController::class, 'register'])->name('post-register');
    Route::get('forgot-password', [AuthenticationController::class, 'forgetPasswordPage'])->name('auth-forgot-password');
    Route::get('reset-password', [AuthenticationController::class, 'resetPasswordPage'])->name('auth-reset-password');
    Route::post('reset-password', [AuthenticationController::class, 'resetPassword'])->name('post-reset-password');
    Route::get('lock-screen', [AuthenticationController::class, 'authLockPage'])->name('auth-lock-screen');
});