<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\BookingController;
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

Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('movie', MovieController::class);

// need to login
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('booking', BookingController::class);
});

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});