<?php declare(strict_types=1);

namespace App\Controllers;

use App\Dto\TodoCreateTransformer;
use App\Dto\TodoUpdateTransformer;
use App\Services\TodoService;
use DI\DependencyException;
use DI\NotFoundException;
use Throwable;

/**
 * Controller.
 */
class TodoController extends Controller
{
    private ToDoCreateTransformer $todoCreateTransformer;

    private ToDoUpdateTransformer $todoUpdateTransformer;

    private TodoService $todoService;


    public function __construct(
        TodoService $todoService,
        TodoCreateTransformer $todoCreateTransformer,
        TodoUpdateTransformer $todoUpdateTransformer
    )
    {
        $this->todoService = $todoService;
        $this->todoCreateTransformer = $todoCreateTransformer;
        $this->todoUpdateTransformer = $todoUpdateTransformer;

        parent::__construct();
    }

    public function index(): string
    {
        return $this->render('todo.index');
    }

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
        $todoDto = $this->todoCreateTransformer->transform($_POST);

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

        return $this->render('messages.info', [
            'messageHeader' => $messageHeader,
            'messageText' => $messageText,
            'messageLink' => $messageLink,
            'messageButton' => $messageButton,
        ]);
    }

    public function edit(int $id): string
    {
        $todo = $this->todoService->find($id);
        if (!$todo) {
            $this->notFound();
        }

        $data = ['todo' => $todo];
        return $this->render('todo.edit', $data);
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     * @throws Throwable
     */
    public function update(int $id): string
    {
        if (!$this->isLogged) {
            return $this->accessDenied();
        }

        $todoDto = $this->todoUpdateTransformer->transform($_POST);

        if ($this->todoService->update($id, $todoDto)) {
            $messageHeader = 'Success';
            $messageText = 'ToDo item was updated.';
            $messageLink = '/';
            $messageButton = 'Ok';
        } else {
            $messageHeader = 'Error';
            $messageText = 'ToDo item was not updated.';
            $messageLink = '/edit/' . $id;
            $messageButton = 'Try again';
        }

        return $this->render('messages.info', [
            'messageHeader' => $messageHeader,
            'messageText' => $messageText,
            'messageLink' => $messageLink,
            'messageButton' => $messageButton,
        ]);
    }
}