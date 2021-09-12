<?php


namespace Dotbcrm\Dotbcrm\Console\CommandRegistry;

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
 * A command can implement one or multiple "mode" marker interface to indicate
 * in which mode it should be available.
 */
interface CommandRegistryInterface
{
    /**
     * Add command to the registry using mode marker interface(s).
     *
     * @param CommandInterface $command
     * @return CommandRegistryInterface
     */
    public function addCommand(CommandInterface $command);

    /**
     * Add multiple commands to the registry using mode marker interface(s).
     *
     * @param CommandInterface[] $commands
     * @return CommandRegistryInterface
     */
    public function addCommands(array $commands);

    /**
     * Add plain symfony command to the registry by explicitly passing the
     * required operation mode(s) instead of using the mode marker interfaces.
     *
     * @param Command $command
     * @param array|string $modes
     * @return CommandRegistryInterface
     */
    public function addSymfonyCommand(Command $command, $modes);

    /**
     * Return commands for given mode.
     *
     * @param string $mode
     * @return Command[]
     */
    public function getCommands($mode);

    /**
     * Validate mode.
     *
     * @param string $mode
     * @return $mode
     */
    public function validateMode($mode);
}
