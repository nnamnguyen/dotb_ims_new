<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener;

use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Listener;

/**
 * Listener builder
 */
interface Builder
{
    /**
     * Creates a listener
     *
     * @return Listener
     */
    public function createListener();
}
