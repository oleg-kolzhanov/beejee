<?php declare(strict_types=1);

namespace App\Routes;

/**
 * Route.
 */
class Route
{
    public Method $method;
    public string $controller;
    public string $action;
    public array $params;
}