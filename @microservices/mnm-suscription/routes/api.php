<?php

use App\Http\Controllers\SuscripcionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get/plan', [SuscripcionController::class, 'getAllPlans']);
Route::get('/get/producto', [SuscripcionController::class, 'getAll']);
Route::post('/create/plan', [SuscripcionController::class, 'createPlan']);
Route::post('/create/producto', [SuscripcionController::class, 'create']); 