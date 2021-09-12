<?php


namespace Dotbcrm\Dotbcrm\DependencyInjection;

use Psr\Container\ContainerInterface;

class Container
{
    /**
     * @var ContainerInterface
     */
    private static $container;

    /**
     * Get a container instance
     *
     * @return ContainerInterface
     */
    public static function getInstance()
    {
        if (!self::$container) {
            self::$container = require DOTB_BASE_DIR . '/etc/container.php';
        }

        return self::$container;
    }

    /**
     * Welcome to the world of singletons!
     */
    public static function resetInstance()
    {
        self::$container = null;
    }
}
