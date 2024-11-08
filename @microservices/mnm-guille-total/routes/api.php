<?php

use App\Http\Controllers\MatchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'matches'], function () {
    Route::post('/importar/excel',[MatchController::class, 'importMatches']);
    Route::get('/listar/pasado',[MatchController::class, 'getMatchesLast']);
    Route::get('/listar/futuro',[MatchController::class, 'getMatchesFuture']);
});