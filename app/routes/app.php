<?php

use App\Controllers\ApiController;
use App\Controllers\AuthController;
use App\Controllers\TodoController;
use FastRoute\RouteCollector;

return function (RouteCollector $r) {
    $r->addRoute('GET', '/', [TodoController::class, 'index']);
    $r->addRoute('GET', '/add', [TodoController::class, 'add']);
    $r->addRoute('POST', '/create', [TodoController::class, 'create']);
    $r->addRoute('GET', '/edit/{id}', [TodoController::class, 'edit']);
    $r->addRoute('POST', '/update/{id}', [TodoController::class, 'update']);
    $r->addRoute('POST', '/done', [TodoController::class, 'done']);
    $r->addRoute('GET', '/view/{id}', [TodoController::class, 'show']);
    $r->addRoute('GET', '/login', [AuthController::class, 'index']);
    $r->addRoute('POST', '/login', [AuthController::class, 'login']);
    $r->addRoute('GET', '/logout', [AuthController::class, 'logout']);
    $r->addRoute('POST', '/api/v1/get', [ApiController::class, 'index']);
};