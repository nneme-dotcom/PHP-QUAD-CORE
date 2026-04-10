<?php
/**
 * Front Controller - ReparaYa
 * Todas las peticiones pasan por aquí gracias al .htaccess.
 */

require __DIR__ . '/../config/config.php';

// Autoload PSR-4 muy simple
spl_autoload_register(function ($class) {
    $prefix   = 'App\\';
    $base_dir = APP_PATH . '/';
    if (strpos($class, $prefix) !== 0) return;
    $relative = substr($class, strlen($prefix));
    $file     = $base_dir . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($file)) require $file;
});

use App\Core\Router;

$router = new Router();

// === Rutas públicas (FrontEnd estático) ===
$router->get('/',              [App\Controllers\HomeController::class, 'index']);
$router->get('/caracteristicas', [App\Controllers\HomeController::class, 'caracteristicas']);
$router->get('/como-funciona',   [App\Controllers\HomeController::class, 'comoFunciona']);
$router->get('/contacto',        [App\Controllers\HomeController::class, 'contacto']);

// === Auth ===
$router->get('/login',     [App\Controllers\AuthController::class, 'showLogin']);
$router->post('/login',    [App\Controllers\AuthController::class, 'doLogin']);
$router->get('/registro',  [App\Controllers\AuthController::class, 'showRegistro']);
$router->post('/registro', [App\Controllers\AuthController::class, 'doRegistro']);
$router->get('/logout',    [App\Controllers\AuthController::class, 'logout']);

// === Perfil (todos los roles) ===
$router->get('/perfil',  [App\Controllers\PerfilController::class, 'edit']);
$router->post('/perfil', [App\Controllers\PerfilController::class, 'update']);

// === Cliente ===
$router->get('/cliente',                 [App\Controllers\ClienteController::class, 'dashboard']);
$router->get('/cliente/avisos',          [App\Controllers\ClienteController::class, 'misAvisos']);
$router->get('/cliente/avisos/nuevo',    [App\Controllers\ClienteController::class, 'nuevoForm']);
$router->post('/cliente/avisos/nuevo',   [App\Controllers\ClienteController::class, 'nuevoStore']);
$router->get('/cliente/avisos/ver',      [App\Controllers\ClienteController::class, 'ver']);
$router->post('/cliente/avisos/cancelar',[App\Controllers\ClienteController::class, 'cancelar']);

// === Técnico ===
$router->get('/tecnico',          [App\Controllers\TecnicoController::class, 'dashboard']);
$router->get('/tecnico/agenda',   [App\Controllers\TecnicoController::class, 'agenda']);

// === Admin ===
$router->get('/admin',                  [App\Controllers\AdminController::class, 'dashboard']);
$router->get('/admin/incidencias',      [App\Controllers\AdminController::class, 'incidencias']);
$router->get('/admin/incidencias/nueva',[App\Controllers\AdminController::class, 'nuevaForm']);
$router->post('/admin/incidencias/nueva',[App\Controllers\AdminController::class, 'nuevaStore']);
$router->get('/admin/incidencias/editar',[App\Controllers\AdminController::class, 'editarForm']);
$router->post('/admin/incidencias/editar',[App\Controllers\AdminController::class, 'editarStore']);
$router->post('/admin/incidencias/asignar',[App\Controllers\AdminController::class, 'asignarTecnico']);
$router->post('/admin/incidencias/cancelar',[App\Controllers\AdminController::class, 'cancelar']);
$router->get('/admin/calendario',       [App\Controllers\AdminController::class, 'calendario']);
$router->get('/admin/api/eventos',      [App\Controllers\AdminController::class, 'apiEventos']);

// CRUD Maestro Técnicos
$router->get('/admin/tecnicos',         [App\Controllers\TecnicosController::class, 'index']);
$router->get('/admin/tecnicos/nuevo',   [App\Controllers\TecnicosController::class, 'nuevoForm']);
$router->post('/admin/tecnicos/nuevo',  [App\Controllers\TecnicosController::class, 'store']);
$router->get('/admin/tecnicos/editar',  [App\Controllers\TecnicosController::class, 'editForm']);
$router->post('/admin/tecnicos/editar', [App\Controllers\TecnicosController::class, 'update']);
$router->post('/admin/tecnicos/borrar', [App\Controllers\TecnicosController::class, 'destroy']);

// CRUD Maestro Especialidades
$router->get('/admin/especialidades',         [App\Controllers\EspecialidadesController::class, 'index']);
$router->post('/admin/especialidades/nueva',  [App\Controllers\EspecialidadesController::class, 'store']);
$router->post('/admin/especialidades/editar', [App\Controllers\EspecialidadesController::class, 'update']);
$router->post('/admin/especialidades/borrar', [App\Controllers\EspecialidadesController::class, 'destroy']);

// CRUD Usuarios (admin)
$router->get('/admin/usuarios',         [App\Controllers\UsuariosController::class, 'index']);
$router->get('/admin/usuarios/editar',  [App\Controllers\UsuariosController::class, 'editForm']);
$router->post('/admin/usuarios/editar', [App\Controllers\UsuariosController::class, 'update']);
$router->post('/admin/usuarios/borrar', [App\Controllers\UsuariosController::class, 'destroy']);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
