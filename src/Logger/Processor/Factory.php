<?php


namespace Dotbcrm\Dotbcrm\Logger\Processor;

/**
 * Interface for processor factories
 */
interface Factory
{
    /**
     * Creates handler
     *
     * @param array $config Processor-specific configuration
     *
     * @return callable
     */
    public function create(array $config);
}
