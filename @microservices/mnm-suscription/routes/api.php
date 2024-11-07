<?php

use App\Http\Controllers\SuscripcionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/suscripcion', [SuscripcionController::class, 'index']);    