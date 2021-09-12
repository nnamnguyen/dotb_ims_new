<?php


namespace Dotbcrm\Dotbcrm\Console\CommandRegistry\Adapter;

use Symfony\Component\Console\Command\Command;

/**
 *
 * Base command adapter interface
 * @see AbstractCommandAdapter
 *
 */
interface CommandAdapterInterface
{
    /**
     * @return Command
     */
    public function getCommand();
}
