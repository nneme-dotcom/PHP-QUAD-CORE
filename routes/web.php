<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TecnicoController;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\GestoraController;
use App\Http\Controllers\Admin\LiquidacionController;
use App\Http\Controllers\Admin\IncidenciaController as AdminIncidencia;
use App\Http\Controllers\Tecnico\IncidenciaController as TecnicoIncidencia;
use App\Http\Controllers\Cliente\IncidenciaController as ClienteIncidencia;

// Ruta raíz (Redirige al login o dashboard)
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// RUTAS ABIERTAS PARA EL VÍDEO (Sin candados de "role")
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- SECCIÓN ADMINISTRACIÓN (Tu Producto 3) ---
    Route::resource('admin/usuarios', UserController::class)->names('admin.usuarios');
    Route::resource('admin/tecnicos', TecnicoController::class)->names('admin.tecnicos');
    Route::resource('admin/especialidades', EspecialidadController::class)->names('admin.especialidades');
    Route::resource('admin/gestoras', GestoraController::class)->names('admin.gestoras');
    Route::resource('admin/liquidaciones', LiquidacionController::class)->names('admin.liquidaciones');
    Route::resource('admin/incidencias', AdminIncidencia::class)->names('admin.incidencias');

    // --- SECCIÓN TÉCNICOS ---
    Route::resource('tecnico/incidencias', TecnicoIncidencia::class)->names('tecnico.incidencias');

    // --- SECCIÓN CLIENTES ---
    Route::resource('cliente/incidencias', ClienteIncidencia::class)->names('cliente.incidencias');
});

// Rutas de autenticación (Login/Logout que ya vienen con Laravel)
require __DIR__.'/auth.php';