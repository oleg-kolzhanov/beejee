<?php declare(strict_types=1);

namespace App\Controllers;

use App\Dto\TodoTransformer;
use App\Services\TodoService;
use DI\DependencyException;
use DI\NotFoundException;
use Throwable;

/**
 * Controller.
 */
class TodoController extends Controller
{
    private TodoTransformer $todoTransformer;

    private TodoService $todoService;


    public function __construct(TodoService $todoService, TodoTransformer $todoTransformer)
    {
        $this->todoService = $todoService;
        $this->todoTransformer = $todoTransformer;

        parent::__construct();
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function index(): string
    {
        return $this->render('todo.index');
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function add(): string
    {
        return $this->render('todo.add');
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     * @throws Throwable
     */
    public function create(): string
    {
        $todoDto = $this->todoTransformer->transform($_POST);

        if ($this->todoService->create($todoDto)) {
            $messageHeader = 'Success';
            $messageText = 'ToDo item was added.';
            $messageLink = '/';
            $messageButton = 'Ok';
        } else {
            $messageHeader = 'Error';
            $messageText = 'ToDo item was not added.';
            $messageLink = '/create';
            $messageButton = 'Try again';
        }

        $template = 'messages.info';

        return $this->render($template, [
            'messageHeader' => $messageHeader,
            'messageText' => $messageText,
            'messageLink' => $messageLink,
            'messageButton' => $messageButton,
        ]);
    }
}