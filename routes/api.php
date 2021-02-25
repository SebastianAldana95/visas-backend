<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\TokensController;
use App\Http\Controllers\Auth\RegisterController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('ventas', VentaController::class);
});*/

Route::group(['middleware' => ['cors']], function () {
    Route::post('/auth/login', [TokensController::class, 'login']);
    Route::post('register', [RegisterController::class, 'apiCreate']);

    Route::group(['middleware' => ['jwt.auth']], function(){
        // Route::resource('ventas', VentaController::class);
        Route::get('ventas', [VentaController::class, 'index']);
        Route::post('ventas', [VentaController::class, 'store']);
        Route::post('auth/refresh', [TokensController::class, 'refreshToken']);
        Route::get('auth/logout', [TokensController::class, 'logout']);
    });
});




