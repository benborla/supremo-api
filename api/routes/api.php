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

/** GUEST ROUTES */
Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::post('login ', \App\Http\Controllers\Auth\AuthController::class . '@login')->name('api.login');
    Route::get('401 ', function () {
        return response()->json(['error' => 'Unauthorized'], 401);
    })->name('api.no_access');
});


/** ROUTES FOR AUTHENTICATED USER */
Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
], function ($router) {
    Route::get('me', \App\Http\Controllers\Auth\AuthController::class . '@me')->name('api.auth.me');
    Route::post('logout', \App\Http\Controllers\Auth\AuthController::class . '@logout')->name('api.auth.logout');
    Route::post('refresh', \App\Http\Controllers\Auth\AuthController::class . '@refresh')->name('api.auth.refresh');
});
