<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServicioController;

Route::get('/servicios/zonas', [ServicioController::class, 'zonas']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
