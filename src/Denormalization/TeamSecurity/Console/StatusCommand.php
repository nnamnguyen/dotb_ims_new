<?php


namespace Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\Console;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Dotbcrm\Dotbcrm\Denormalization\TeamSecurity\State;
use Dotbcrm\Dotbcrm\DependencyInjection\Container;

/**
 * Display the status of the denormalized data.
 */
class StatusCommand extends Command implements InstanceModeInterface
{
    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('team-security:status')
            ->setDescription('Display the status of the denormalized data');
    }

    /**
     * {inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $state = Container::getInstance()->get(State::class);

        $table = new Table($output);
        $table->setHeaders(['Parameter', 'Value']);
        $table->addRows([
            [
                'Enabled',
                $this->printBoolean($state->isEnabled()),
            ],
            [
                'Active table',
                $this->printNullable($state->getActiveTable()),
            ],
            [
                'Up to date',
                $this->printBoolean($state->isUpToDate()),
            ],
            [
                'Rebuild is running',
                $this->printBoolean($state->isRebuildRunning()),
            ],
        ]);

        $table->render();
    }

    /**
     * Print boolean value
     *
     * @param bool $value
     * @return string
     */
    private function printBoolean($value)
    {
        return $value ? 'Yes' : 'No';
    }

    /**
     * Print nullable value
     *
     * @param mixed $value
     * @return string
     */
    private function printNullable($value)
    {
        if ($value === null) {
            return 'None';
        }

        return $value;
    }
}
