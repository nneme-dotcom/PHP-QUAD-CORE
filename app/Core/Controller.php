<?php
namespace App\Core;

abstract class Controller
{
    /**
     * Renderiza una vista dentro del layout principal.
     */
    protected function view(string $view, array $data = [], string $layout = 'layouts/main'): void
    {
        extract($data);
        $contentFile = VIEW_PATH . '/' . $view . '.php';
        if (!file_exists($contentFile)) {
            die('Vista no encontrada: ' . $view);
        }
        // Capturamos la vista interna en $content
        ob_start();
        require $contentFile;
        $content = ob_get_clean();
        // Y la inyectamos en el layout
        require VIEW_PATH . '/' . $layout . '.php';
    }

    /**
     * Renderiza una vista SIN layout (login, errores...).
     */
    protected function viewRaw(string $view, array $data = []): void
    {
        extract($data);
        require VIEW_PATH . '/' . $view . '.php';
    }

    protected function redirect(string $uri): void
    {
        header('Location: ' . $uri);
        exit;
    }

    protected function requireAuth(?string $rol = null): void
    {
        Auth::start();
        if (!Auth::check()) {
            $this->redirect('/login');
        }
        if ($rol !== null && Auth::user()['rol'] !== $rol) {
            http_response_code(403);
            require VIEW_PATH . '/errors/403.php';
            exit;
        }
    }

    protected function input(string $key, $default = null)
    {
        $value = $_POST[$key] ?? $_GET[$key] ?? $default;
        return is_string($value) ? trim($value) : $value;
    }

    protected function csrfCheck(): void
    {
        Auth::start();
        $token = $_POST['_csrf'] ?? '';
        if (!$token || !hash_equals($_SESSION['_csrf'] ?? '', $token)) {
            http_response_code(419);
            die('Token CSRF inválido.');
        }
    }
}
