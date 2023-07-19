<?php declare(strict_types=1);

namespace App\Responses;

use App\App;
use App\AppContainer;
use DI\Container;
use FastRoute\Dispatcher;

/**
 *
 */
class Response
{
    /**
     * @var Container App DI container.
     */
    private Container $container;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->container = AppContainer::getInstance()->getContainer();
    }

    /**
     * Return response.
     *
     * @param array $route Route
     * @return void
     */
    public function response(array $route): void
    {
        $status = $this->getStatus($route);

        switch ($status) {
            case Dispatcher::NOT_FOUND:
                echo '404 Not Found';
                break;

            case Dispatcher::METHOD_NOT_ALLOWED:
                echo '405 Method Not Allowed';
                break;

            case Dispatcher::FOUND:
                $controller = $this->getCallable($route);
                $parameters = $this->getParameters($route);

                $result = $this->container->call($controller, $parameters);
                echo $result;
                break;
        }
    }

    /**
     * Get status.
     *
     * @param $route
     * @return int
     */
    private function getStatus($route): int
    {
        return $route[0];
    }

    /**
     * Get route callable.
     *
     * @param $route
     * @return string|array
     */
    private function getCallable($route): string|array
    {
        return $route[1];
    }

    /**
     * Get parameters.
     *
     * @param $route
     * @return array
     */
    private function getParameters($route): array
    {
        return $route[2];
    }
}