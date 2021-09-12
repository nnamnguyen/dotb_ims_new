<?php


namespace Dotbcrm\Dotbcrm\Console\Command\Api;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 *
 * SearchEngine schedule full reindex
 *
 */
class SearchReindexCommand extends Command implements InstanceModeInterface
{
    use ApiEndpointTrait;

    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('search:reindex')
            ->setDescription('Create mappings and schedule a reindex')
            ->addOption(
                'modules',
                null,
                InputOption::VALUE_REQUIRED,
                'Comma separated list of modules to be reindexed. Defaults to all search enabled modules.'
            )
            ->addOption(
                'clearData',
                null,
                InputOption::VALUE_NONE,
                'Clear the data of the involved index/indices before reindexing the records.'
            )
        ;
    }

    /**
     * {inheritdoc}
     *
     * Return codes:
     * 0 = scheduling sucessfull
     * 1 = scheduling error
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $result = $this
            ->initApi($this->getApi())
            ->callApi('searchReindex', array(
                'module_list' => $input->getOption('modules'),
                'clear_data' => $input->getOption('clearData'),
            ))
        ;

        $status = $result['success'];

        if ($status) {
            $output->writeln('Reindex succesfully scheduled');
        } else {
            $output->writeln('Something went wrong, check your logs');
        }

        return $status ? 0 : 1;
    }

    /**
     * @return \AdministrationApi
     */
    protected function getApi()
    {
        return new \AdministrationApi();
    }
}
