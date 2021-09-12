<?php


namespace Dotbcrm\Dotbcrm\Console\CommandRegistry\Adapter;

use Symfony\Component\Console\Command\Command;

/**
 *
 * Base command adapter used to adapt a stock symfony command using the "mode"
 * marker interfaces required by CommandRegistry.
 *
 * The adapter classes are not part of the public api of the CLI framework and
 * are solely used by the CommandRegistry.
 *
 */
abstract class AbstractCommandAdapter implements CommandAdapterInterface
{
    /**
     * @var Command
     */
    protected $command;

    /**
     * Ctor
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Overload
     * @param string $method
     * @param array $args
     */
    public function __call($method, array $args)
    {
        return call_user_func_array(array($this->command, $method), $args);
    }

    /**
     * {@inheritdoc}
     */
    public function getCommand()
    {
        return $this->command;
    }
}
