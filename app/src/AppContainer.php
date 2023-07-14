<?php declare(strict_types=1);

namespace App;

use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;

/**
 * Приложение.
 */
class AppContainer
{
    private static self $instance;

    private Container $container;

    /**
     * @throws Exception
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function __construct() {
        $this->initContainer();
    }

    protected function __clone() { }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize AppContainer");
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new AppContainer();
        }
        return self::$instance;
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @throws Exception
     */
    private function initContainer(): void
    {
        $containerBuilder = new ContainerBuilder;
        $containerBuilder->addDefinitions(APP_DIR . '/config/container.php');
        $this->container = $containerBuilder->build();
    }
}