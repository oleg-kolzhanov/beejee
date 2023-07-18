<?php declare(strict_types=1);

namespace App;

use App\Controllers\ApiController;
use App\Controllers\AuthController;
use App\Controllers\TodoController;
use App\Responses\Response;
use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Opis\Database\Database;
use Opis\Database\Connection;

/**
 * Приложение.
 */
class App
{
    private static self $instance;

    private Container $container;

    private Dispatcher $dispatcher;

    private Response $response;

    private array $config;

    private Database $db;

    /**
     * @throws Exception
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function __construct() {
        $this->initContainer();
        $this->initConfig();
        $this->initDb();
        $this->initDispatcher();
        $this->initResponse();
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize App");
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    /**
     * Метод по умолчанию.
     *
     * @return void
     */
    public function __invoke(): void
    {

        $httpMethod = $_SERVER['REQUEST_METHOD'];
//        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $route = $this->dispatcher->dispatch($httpMethod, $uri);
        $this->response->response($route);
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @return Dispatcher
     */
    public function getDispatcher(): Dispatcher
    {
        return $this->dispatcher;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @return Database
     */
    public function getDb(): Database
    {
        return $this->db;
    }

    /**
     * @throws Exception
     */
    private function initContainer(): void
    {
        $this->container = AppContainer::getInstance()->getContainer();
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    private function initDb(): void
    {
        $config = $this->config['db'];

        $connection = new Connection(
            $config['dsn'],
            $config['username'],
            $config['password']
        );

        $this->db = $this->container->make(Database::class, ['connection' => $connection]);
    }

    /**
     * @return void
     */
    private function initDispatcher(): void
    {
        $this->dispatcher = simpleDispatcher(function (RouteCollector $r) {
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
        });
    }

    /**
     * @return void
     * @throws DependencyException
     * @throws NotFoundException
     */
    private function initResponse(): void
    {
        $this->response = $this->container->make(Response::class);
    }

    /**
     * @return void
     */
    private function initConfig(): void
    {
        $this->config = include APP_DIR. '/config/app.php';
    }
}