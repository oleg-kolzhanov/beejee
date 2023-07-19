<?php declare(strict_types=1);

namespace App;

use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;

/**
 * Application DI container.
 */
class AppContainer
{
    /**
     * @var AppContainer App DI container singleton instance.
     */
    private static self $instance;

    /**
     * @var Container Base DI container singleton instance.
     */
    private Container $container;

    /**
     * Constructor.
     *
     * @throws Exception
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function __construct() {
        $this->initContainer();
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
        throw new Exception("Cannot unserialize AppContainer");
    }

    /**
     * Return app DI container singleton instance.
     *
     * @return self
     */
    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new AppContainer();
        }
        return self::$instance;
    }

    /**
     * Return app DI container.
     *
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * Init app DI container.
     *
     * @return void
     * @throws Exception
     */
    private function initContainer(): void
    {
        $containerBuilder = new ContainerBuilder;
        $containerBuilder->addDefinitions(APP_DIR . '/config/container.php');
        $this->container = $containerBuilder->build();
    }
}