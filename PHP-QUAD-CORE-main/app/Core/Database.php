<?php
namespace App\Core;

use PDO;
use PDOException;

/**
 * Singleton de conexión PDO a MySQL.
 * Usa sentencias preparadas en TODO el proyecto (PDO::prepare).
 */
class Database
{
    private static ?PDO $instance = null;

    public static function getInstance(): PDO
{
    if (self::$instance === null) {
        $dsn = 'mysql:host=' . (defined('DB_HOST') ? constant('DB_HOST') : 'localhost')
            . ';port=' . (defined('DB_PORT') ? constant('DB_PORT') : '3306')
            . ';dbname=' . (defined('DB_NAME') ? constant('DB_NAME') : '')
            . ';charset=' . (defined('DB_CHARSET') ? constant('DB_CHARSET') : 'utf8mb4');

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            self::$instance = new PDO(
                $dsn,
                defined('DB_USER') ? constant('DB_USER') : '',
                defined('DB_PASS') ? constant('DB_PASS') : '',
                $options
            );
        } catch (PDOException $e) {
            if (defined('APP_DEBUG') && constant('APP_DEBUG')) {
                die('Error de conexión a la BBDD: ' . $e->getMessage());
            }
            die('No se ha podido conectar con la base de datos.');
        }
    }

    return self::$instance;
}
    private function __construct() {}
    private function __clone() {}
}