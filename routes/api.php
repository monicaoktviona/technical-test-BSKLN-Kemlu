<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/negara', App\Http\Controllers\Api\NegaraController::class);

Route::apiResource('/kawasan', App\Http\Controllers\Api\KawasanController::class);

Route::apiResource('/direktorat', App\Http\Controllers\Api\DirektoratController::class);

