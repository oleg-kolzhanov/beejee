<?php declare(strict_types=1);

namespace App\Controllers;

use App\Dto\RequestTransformer;
use App\Services\TodoService;
use DI\DependencyException;
use DI\NotFoundException;
use Throwable;

/**
 * API Controller.
 */
class ApiController extends Controller
{
    /**
     * @var RequestTransformer Dataset request transformer.
     */
    private RequestTransformer $requestTransformer;

    /**
     * @var TodoService To Do service.
     */
    private TodoService $todoService;

    /**
     * Constructor.
     *
     * @param TodoService $todoService To Do service
     * @param RequestTransformer $requestTransformer Dataset request transformer
     */
    public function __construct(TodoService $todoService, RequestTransformer $requestTransformer)
    {
        $this->todoService = $todoService;
        $this->requestTransformer = $requestTransformer;

        parent::__construct();
    }

    /**
     * Show To Do dataset.
     *
     * @return string
     * @throws Throwable
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function index(): string
    {
        $requestDto =  $this->requestTransformer->transform($_POST);
        $data = $this->todoService->get($requestDto);

        return $this->resource($data);
    }
}