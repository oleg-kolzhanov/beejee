<?php declare(strict_types=1);

namespace App\Routes;

use DI;

/**
 * Router.
 */
class Router
{
    public array $routes;
    public string $controller;
    public string $action;
    public string $method;
    protected array $params;

    public function get(string $pattern, string $callback): void
    {
        $this->route(Method::GET, $pattern, $callback);
    }

    public function put(string $pattern, string $callback): void
    {
        $this->route(Method::PUT, $pattern, $callback);
    }

    public function post(string $pattern, string $callback): void
    {
        $this->route(Method::POST, $pattern, $callback);
    }

    public function delete(string $pattern, string $callback): void
    {
        $this->route(Method::DELETE, $pattern, $callback);
    }

    public function route(Method $method, string $pattern, string $callback): void
    {
        $route = $this->makeRoute($method, $pattern, $callback);
        $this->routes[$this->preparePattern($pattern)] = $route;
    }

    public function dispatch(string $url): mixed
    {
        /** @var Route $route */
        foreach ($this->routes as $pattern => $route) {
            if (preg_match($pattern, $url, $params)) {
                array_shift($params);
                $controller = $route->controller . 'Controller';
                $action = $route->action . 'Action';
                return $$controller->$action(array_values($params));
//                return call_user_func_array($callback, array_values($params));
            }
        }
        return null;
    }

    /**
     * @param $pattern
     * @return string
     */
    private function preparePattern($pattern): string
    {
        return '/^' . str_replace('/', '\/', $pattern) . '$/';
    }

    /**
     * @param $callback
     * @return array|false|string[]
     */
    private function parseCallback($callback): array|false
    {
        return preg_split('@', $callback);
    }

    private function makeRoute(Method $method, string $pattern, string $callback): Route
    {
//        /** @var Route $route */
//        $route = DI\get(Route::class);
        $route = new Route();
        $route->method = $method;
        [$route->controller, $route->action] = $this->parseCallback($callback);
        $this->routes[$this->preparePattern($pattern)] = $callback;
    }
}