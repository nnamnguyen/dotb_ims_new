<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Console;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Command\StateAwareRebuild;
use Dotbcrm\Dotbcrm\DependencyInjection\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Rebuild denormalized team security data.
 */
class RebuildCommand extends Command implements InstanceModeInterface
{
    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('team-security:rebuild')
            ->setDescription('Rebuild denormalized team security data')
            ->addOption(
                'ignore-up-to-date',
                null,
                InputOption::VALUE_NONE,
                'Run even if the data is up to date'
            )
        ;
    }

    /**
     * {inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = Container::getInstance()->get(StateAwareRebuild::class);
        $ignoreUpToDate = $input->getOption('ignore-up-to-date');
        list($status, $message) = $command($ignoreUpToDate);
        $output->writeln($message);

        return $status ? 0 : 1;
    }
}
