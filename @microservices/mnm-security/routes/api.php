<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Cors;


Route::group(['middleware' => [Cors::class]], function () {
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::post('/register', [AuthController::class, 'register']);
    Route::group(['middleware' => ['jwt.auth', Cors::class]], function () {
        Route::group(['prefix' => 'Auth'], function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/user', [AuthController::class, 'getUserById']);
        });
    });
});
