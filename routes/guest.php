<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SolarController;
use App\Http\Controllers\ThaiAddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

// Authentication  Route
Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthenticationController::class, 'loginPage'])->name('auth-login');
    Route::post('login', [AuthenticationController::class, 'login'])->name('post-login');
    Route::get('register', [AuthenticationController::class, 'registerPage'])->name('auth-register');
    Route::post('register', [AuthenticationController::class, 'register'])->name('post-register');
    Route::get('forgot-password', [AuthenticationController::class, 'forgetPasswordPage'])->name(
        'auth-forgot-password'
    );
    Route::get('reset-password', [AuthenticationController::class, 'resetPasswordPage'])->name('auth-reset-password');
    Route::post('reset-password', [AuthenticationController::class, 'resetPassword'])->name('post-reset-password');
    Route::get('lock-screen', [AuthenticationController::class, 'authLockPage'])->name('auth-lock-screen');
});

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('lang-locale');

Route::get('solar', [SolarController::class, 'index'])->name('solar.index');
Route::post('solar/line-notify', [SolarController::class, 'lineNotify'])->name('solar.line-notify');

Route::get('provinces', [ThaiAddressController::class, 'provinces'])->name('thai-address.provinces');
Route::get('amphures', [ThaiAddressController::class, 'amphures'])->name('thai-address.amphures');
Route::get('districts', [ThaiAddressController::class, 'districts'])->name('thai-address.districts');
Route::get('geographies', [ThaiAddressController::class, 'geographies'])->name('thai-address.geographies');

//Route::get('test', function () {
//    if (!$user = \App\Models\User::where('email', 'devilpooh@gmail.com')->first()) {
//        return 'FAIL to get user';
//    }
//
//    $role = \Spatie\Permission\Models\Role::where('name', 'super-admin')->first();
//    if (!$role) {
//        $role = \Spatie\Permission\Models\Role::create(['name' => 'super-admin']);
//    }
//
//    if (!$role) {
//        return 'FAIL to get role';
//    }
//    $user->assignRole($role);
//
//    dd($user, $role, $user->getRoleNames());
//});

//Route::get('addAllVisitorRole', function () {
//    $role = \Spatie\Permission\Models\Role::where('name', 'visitor')->first();
//    if (!$role) {
//        $role = \Spatie\Permission\Models\Role::create(['name' => 'visitor']);
//    }
//
//    if (!$role) {
//        return 'FAIL to get role';
//    }
//
//    if (!$users = \App\Models\User::all()) {
//        return 'FAIL to get user';
//    }
//
//    $user = null;
//
//    foreach ($users as &$user){
//        $user->assignRole($role);
//    }
//
//    dd($user, $user->getRoleNames());
//});
