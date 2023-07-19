<?php declare(strict_types=1);

namespace App;

use App\Responses\Response;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;
use Opis\Database\Database;
use Opis\Database\Connection;

/**
 * Application.
 */
class App
{
    /**
     * @var App App singleton instance.
     */
    private static self $instance;

    /**
     * @var Container DI container instance.
     */
    private Container $container;

    /**
     * @var Dispatcher App dispatcher instance.
     */
    private Dispatcher $dispatcher;

    /**
     * @var Response App response instance.
     */
    private Response $response;

    /**
     * @var array App config.
     */
    private array $config;

    /**
     * @var Database App database instance.
     */
    private Database $db;

    /**
     * Constructor.
     *
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

    /**
     * Don't allow to clone.
     *
     * @return void
     */
    protected function __clone(): void { }

    /**
     * Don't allow to wakeup.
     *
     * @return void
     * @throws Exception
     */
    public function __wakeup(): void
    {
        throw new Exception("Cannot unserialize App");
    }

    /**
     * Return app singleton instance.
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new App();
        }
        return self::$instance;
    }

    /**
     * Default method.
     *
     * @return void
     */
    public function __invoke(): void
    {

        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        $route = $this->dispatcher->dispatch($httpMethod, $uri);
        $this->response->response($route);
    }

    /**
     * Return app DI container instance.
     *
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * Return app dispatcher instance.
     *
     * @return Dispatcher
     */
    public function getDispatcher(): Dispatcher
    {
        return $this->dispatcher;
    }

    /**
     * Return app response instance.
     *
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * Return app config.
     *
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * Return app database instance.
     *
     * @return Database
     */
    public function getDb(): Database
    {
        return $this->db;
    }

    /**
     * Initialize app DI container instance.
     *
     * @throws Exception
     */
    private function initContainer(): void
    {
        $this->container = AppContainer::getInstance()->getContainer();
    }

    /**
     * Initialize app database instance.
     *
     * @return void
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
     * Initialize app dispatcher instance.
     *
     * @return void
     */
    private function initDispatcher(): void
    {
        $this->dispatcher = simpleDispatcher(
            include APP_DIR . '/routes/app.php'
        );
    }

    /**
     * Initialize app response instance.
     *
     * @return void
     * @throws DependencyException
     * @throws NotFoundException
     */
    private function initResponse(): void
    {
        $this->response = $this->container->make(Response::class);
    }

    /**
     * Initialize app config.
     *
     * @return void
     */
    private function initConfig(): void
    {
        $this->config = include APP_DIR . '/config/app.php';
    }
}