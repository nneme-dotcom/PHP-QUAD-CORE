<?php
namespace App\Core;

class Auth
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_name(SESSION_NAME);
            session_set_cookie_params([
                'lifetime' => SESSION_LIFETIME,
                'path'     => '/',
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            session_start();
            if (empty($_SESSION['_csrf'])) {
                $_SESSION['_csrf'] = bin2hex(random_bytes(32));
            }
        }
    }

    public static function login(array $user): void
    {
        self::start();
        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id'      => (int)$user['id'],
            'nombre'  => $user['nombre'],
            'email'   => $user['email'],
            'rol'     => $user['rol'],
        ];
    }

    public static function logout(): void
    {
        self::start();
        $_SESSION = [];
        session_destroy();
    }

    public static function check(): bool
    {
        self::start();
        return isset($_SESSION['user']);
    }

    public static function user(): ?array
    {
        self::start();
        return $_SESSION['user'] ?? null;
    }

    public static function csrf(): string
    {
        self::start();
        return $_SESSION['_csrf'];
    }
}
