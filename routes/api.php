<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/convertLocaleDate', function (Request $request) {
    if ($request->ajax() && $request->has('value')) {
        return [
            'localDate' => buddhismDate($request->get('value'))
        ];
    }

    return [
        'localDate' => $request->get('value')
    ];
})->name('api.convertLocaleDate');
