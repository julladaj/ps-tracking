<?php

use App\Http\Controllers\MetersController;
use App\Http\Controllers\UsersController;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

// dashboard Routes
// Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');
//Route::get('/', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');

Route::get('/', function() {
    if (RouteServiceProvider::HOME !== '/') {
        return redirect(RouteServiceProvider::HOME);
    }
    return redirect(route('meters.index'));
});

Route::post('meters-filter', function(\Illuminate\Http\Request $request) {
    session(['meters-filter' => $request->all()]);
    return redirect(route('meters.index'));
})->name('meters-filter');

Route::get('meters-filter-unset', function() {
    session()->forget('meters-filter');
    return redirect(route('meters.index'));
})->name('meters-filter-unset');

Route::resource('meters', MetersController::class);

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('ecommerce', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
    Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
});

Route::resource('users', UsersController::class);

Route::get('pdf/{meter}', [\App\Http\Controllers\PDFController::class, 'show'])->name('meter-pdf');
Route::get('pdf-payment/{meter}', [\App\Http\Controllers\PDFController::class, 'payment'])->name('meter-payment-pdf');
