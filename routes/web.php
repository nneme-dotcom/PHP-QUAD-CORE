<?php

use Illuminate\Support\Facades\Route;
// Importamos el controlador para que el archivo sepa dónde está
use App\Http\Controllers\GestoraController;

Route::get('/', function () {
    return view('welcome');
});

// Esta es la nueva ruta para el Punto A y B
Route::get('/gestoras', [GestoraController::class, 'index'])->name('gestoras.index');
