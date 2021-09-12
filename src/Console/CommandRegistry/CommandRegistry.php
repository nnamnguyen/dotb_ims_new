<?php


namespace Dotbcrm\Dotbcrm\Console\CommandRegistry;

use Dotbcrm\Dotbcrm\Console\Exception\CommandRegistryException;
use Dotbcrm\Dotbcrm\Console\CommandRegistry\Adapter\CommandAdapterInterface;
use Symfony\Component\Console\Command\Command;

/**
 *
 * DotBCRM console command registry
 *
 * All CLI commands need to be registered through this command registry.
 * Having all commands in a separate registry allows decoupling the command
 * registration process from the console application to be able to properly
 * initialize stock and custom commands.
 *
 * Commands are available based on their selected mode.
 *
 */
class CommandRegistry implements CommandRegistryInterface
{
    const MODE_STANDALONE = 'StandaloneMode';
    const MODE_INSTANCE = 'InstanceMode';

    /**
     * @var CommandRegistry
     */
    protected static $instance;

    /**
     * Supported modes
     * @var array
     */
    protected $modes = array(
        self::MODE_STANDALONE,
        self::MODE_INSTANCE,
    );

    /**
     * Registered commands
     * @var CommandInterface[]
     */
    protected $commands;

    /**
     * Get instance
     * @return CommandRegistry
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * {@inheritdoc}
     */
    public function addCommand(CommandInterface $command)
    {
        $this->commands[] = $command;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addCommands(array $commands)
    {
        foreach ($commands as $command) {
            $this->addCommand($command);
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addSymfonyCommand(Command $command, $modes)
    {
        if (!is_array($modes)) {
            $modes = array($modes);
        }

        foreach ($modes as $mode) {
            $this->validateMode($mode);
            $this->addCommand($this->createAdapter($command, $mode));
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCommands($mode)
    {
        $interface = sprintf(
            'Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\%sInterface',
            $this->validateMode($mode)
        );

        // commands we can extract directly (non-adapters)
        $commands = array_filter($this->commands, function ($command) use ($interface) {
            return $command instanceof $interface && $command instanceof Command;
        });

        // commands we need to pick up from the adapters
        $adapters = array_filter($this->commands, function ($command) use ($interface) {
            return $command instanceof $interface && $command instanceof CommandAdapterInterface;
        });

        foreach ($adapters as $adapter) {
            $commands[] = $adapter->getCommand();
        }

        return array_values($commands);
    }

    /**
     * {@inheritdoc}
     */
    public function validateMode($mode)
    {
        if (!in_array($mode, $this->modes)) {
            throw new CommandRegistryException("Invalid mode '{$mode}' requested");
        }
        return $mode;
    }

    /**
     * Create command adapter object
     * @param Command $command
     * @param string $mode
     * @return CommandInterface
     */
    protected function createAdapter(Command $command, $mode)
    {
        $class = sprintf(
            'Dotbcrm\Dotbcrm\Console\CommandRegistry\Adapter\%sCommand',
            $mode
        );

        if (!class_exists($class)) {
            throw new CommandRegistryException("No adapter available for '{$mode}' mode");
        }

        return new $class($command);
    }
}
