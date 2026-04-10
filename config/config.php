<?php
/**
 * ReparaYa - Configuración centralizada
 * Grupo: PHP QUAD-CORE
 * FP.448 - Desarrollo back-end con PHP, framework MVC y gestor de contenido
 */

// === Entorno ===
define('APP_NAME', 'ReparaYa');
define('APP_ENV', getenv('APP_ENV') ?: 'local'); // local | aws
define('APP_DEBUG', APP_ENV === 'local');

// === URL base (cambia automáticamente entre local y AWS) ===
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
define('BASE_URL', $scheme . '://' . $host);

// === Base de datos (variables de entorno con fallback a Docker local) ===
define('DB_HOST', getenv('DB_HOST') ?: 'mysql');     // 'mysql' = nombre del servicio docker-compose
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'reparaya');
define('DB_USER', getenv('DB_USER') ?: 'reparaya');
define('DB_PASS', getenv('DB_PASS') ?: 'reparaya');
define('DB_CHARSET', 'utf8mb4');

// === Sesiones ===
define('SESSION_NAME', 'REPARAYA_SID');
define('SESSION_LIFETIME', 60 * 60 * 2); // 2 h

// === Rutas físicas ===
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH',  ROOT_PATH . '/app');
define('VIEW_PATH', APP_PATH  . '/Views');

// === Reglas de negocio ===
define('HORAS_ANTELACION_ESTANDAR', 48); // No se puede pedir/cancelar con menos de 48 h

// === Errores ===
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
    error_reporting(0);
    ini_set('display_errors', '0');
}
