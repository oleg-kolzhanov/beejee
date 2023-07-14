<?php declare(strict_types=1);

namespace App\Controllers;

/**
 * Controller.
 */
class TodoController extends Controller
{
    public function index(): string
    {
        return $this->render('todo.index');
    }
}