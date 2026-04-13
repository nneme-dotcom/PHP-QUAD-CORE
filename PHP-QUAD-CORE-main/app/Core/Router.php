<?php
namespace App\Core;

/**
 * Router muy simple basado en una tabla GET/POST -> Controller@method.
 * El front controller (public/index.php) redirige TODO aquí.
 */
class Router
{
    private array $routes = ['GET' => [], 'POST' => []];

    public function get(string $uri, array $action): void
    {
        $this->routes['GET'][$this->normalize($uri)] = $action;
    }

    public function post(string $uri, array $action): void
    {
        $this->routes['POST'][$this->normalize($uri)] = $action;
    }

    public function dispatch(string $method, string $uri): void
    {
        $uri = $this->normalize(parse_url($uri, PHP_URL_PATH) ?? '/');

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            require VIEW_PATH . '/errors/404.php';
            return;
        }

        [$controllerClass, $action] = $this->routes[$method][$uri];
        $controller = new $controllerClass();
        $controller->$action();
    }

    private function normalize(string $uri): string
    {
        $uri = '/' . trim($uri, '/');
        return $uri === '' ? '/' : $uri;
    }
}
