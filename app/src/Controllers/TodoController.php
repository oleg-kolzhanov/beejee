<?php declare(strict_types=1);

namespace App\Controllers;

use App\Dto\TodoCreateTransformer;
use App\Dto\TodoUpdateTransformer;
use App\Services\TodoService;
use DI\DependencyException;
use DI\NotFoundException;
use Throwable;

/**
 * To Do Controller.
 */
class TodoController extends Controller
{
    /**
     * @var TodoCreateTransformer Transformer for To Do create request
     */
    private ToDoCreateTransformer $todoCreateTransformer;

    /**
     * @var TodoUpdateTransformer Transformer for To Do update request
     */
    private ToDoUpdateTransformer $todoUpdateTransformer;

    /**
     * @var TodoService To Do service
     */
    private TodoService $todoService;

    /**
     * @param TodoService $todoService To Do service
     * @param TodoCreateTransformer $todoCreateTransformer Transformer for To Do create request
     * @param TodoUpdateTransformer $todoUpdateTransformer Transformer for To Do update request
     * @throws DependencyException
     * @throws NotFoundException
     */
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

    /**
     * Show To Do list.
     *
     * @return string
     */
    public function index(): string
    {
        return $this->render('todo.index');
    }

    /**
     * Show To Do adding form.
     *
     * @return string
     */
    public function add(): string
    {
        return $this->render('todo.add');
    }

    /**
     * Create To Do.
     *
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

        return $this->message($messageHeader, $messageText, $messageLink, $messageButton);
    }

    /**
     * Show To Do edit form.
     *
     * @param int $id To Do identificator
     * @return string
     */
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
     * Update To Do.
     *
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

        return $this->message($messageHeader, $messageText, $messageLink, $messageButton);
    }
}