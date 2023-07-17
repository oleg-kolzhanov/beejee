<?php declare(strict_types=1);

namespace App\Controllers;

use App\Dto\RequestTransformer;
use App\Services\TodoService;
use DI\DependencyException;
use DI\NotFoundException;
use Throwable;

/**
 * Controller.
 */
class ApiController extends Controller
{
    private RequestTransformer $requestTransformer;

    private TodoService $todoService;

    public function __construct(TodoService $todoService, RequestTransformer $requestTransformer)
    {
        $this->todoService = $todoService;
        $this->requestTransformer = $requestTransformer;

        parent::__construct();
    }

    /**
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