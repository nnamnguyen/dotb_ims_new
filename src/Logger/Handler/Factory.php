<?php


namespace Dotbcrm\Dotbcrm\Logger\Handler;

use Monolog\Handler\HandlerInterface;

/**
 * Interface for handler factories
 */
interface Factory
{
    /**
     * Creates handler
     *
     * @param int $level Logging level
     * @param array $config Handler-specific configuration
     *
     * @return HandlerInterface
     */
    public function create($level, array $config);
}
