<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\TecnicoController;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\IncidenciaAdminController;
use App\Http\Controllers\Admin\GestoraAdminController;
use App\Http\Controllers\Admin\LiquidacionController;
use App\Http\Controllers\Cliente\IncidenciaClienteController;
use App\Http\Controllers\Tecnico\IncidenciaTecnicoController;
use App\Http\Controllers\Gestora\IncidenciaGestoraController;
use App\Http\Controllers\Gestora\ComisionController;

// Raíz -> login
Route::get('/', fn() => redirect()->route('login'));

// Auth
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (todos los roles autenticados)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('role')
    ->name('dashboard');

// ── ADMIN ──────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {

    Route::resource('usuarios',       UsuarioController::class);
    Route::resource('tecnicos',       TecnicoController::class);
    Route::resource('especialidades', EspecialidadController::class);
    Route::resource('incidencias',    IncidenciaAdminController::class);

    Route::post('incidencias/{incidencia}/asignar', [IncidenciaAdminController::class, 'asignar'])->name('incidencias.asignar');
    Route::post('incidencias/{incidencia}/estado',  [IncidenciaAdminController::class, 'estado'])->name('incidencias.estado');

    Route::resource('gestoras', GestoraAdminController::class);
    Route::get('liquidaciones', [LiquidacionController::class, 'index'])->name('liquidaciones.index');
});

// ── CLIENTE ────────────────────────────────────────────────────────────────
Route::prefix('cliente')->name('cliente.')->middleware('role:particular')->group(function () {
    Route::resource('incidencias', IncidenciaClienteController::class)
         ->only(['index', 'create', 'store', 'show']);
});

// ── TÉCNICO ────────────────────────────────────────────────────────────────
Route::prefix('tecnico')->name('tecnico.')->middleware('role:tecnico')->group(function () {
    Route::resource('incidencias', IncidenciaTecnicoController::class)
         ->only(['index', 'show']);
    Route::post('incidencias/{incidencia}/estado', [IncidenciaTecnicoController::class, 'estado'])
         ->name('incidencias.estado');
});

// ── GESTORA ────────────────────────────────────────────────────────────────
Route::prefix('gestora')->name('gestora.')->middleware('role:gestora')->group(function () {
    Route::resource('incidencias', IncidenciaGestoraController::class)
         ->only(['index', 'create', 'store', 'show']);
    Route::get('comisiones', [ComisionController::class, 'index'])->name('comisiones.index');
});
