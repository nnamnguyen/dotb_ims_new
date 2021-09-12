<?php


namespace Dotbcrm\Dotbcrm\Console\Command\Elasticsearch;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Dotbcrm\Dotbcrm\SearchEngine\SearchEngine;
use Dotbcrm\Dotbcrm\SearchEngine\Engine\Elastic;
use Dotbcrm\Dotbcrm\Elasticsearch\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

/**
 *
 * Silent Reindex Command
 *
 * This command will run a full reindex inline without relying on
 * cron. It is advised not to run this command when cron is enabled
 * as the elastic search scheduler will create consumer jobs as well.
 * This may lead to unpredicatable situations. Use this command only
 * during development or in a controlled environment.
 *
 */
class SilentReindexCommand extends Command implements InstanceModeInterface
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('search:silent_reindex')
            ->setDescription('Create mappings and index the data')
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
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $engine = SearchEngine::getInstance()->getEngine();

        if (!$engine instanceof Elastic) {
            throw new RuntimeException("Backend search engine is not Elastic");
        }

        $this->container = $engine->getContainer();

        if ($input->getOption('modules')) {
            $modules = explode(',', $input->getOption('modules'));
        } else {
            $modules = $this->getAllModules();
        }

        $clearData = (bool) $input->getOption('clearData');

        $output->writeln("Scheduling reindex ... ");
        if ($this->scheduleIndexing($modules, $clearData)) {
            $output->writeln("Consuming queue ... please be patient");
            $count = 0;
            while ($this->hasMoreRecords()) {
                $this->consumeQueue();
                $count++;
                $output->writeln("Consuming queue ... finish batch #" . $count);
            }
        }
        $output->writeln("Reindexing complete");
    }

    /**
     * Wrapper to get all enabled modules
     * @return array
     */
    protected function getAllModules()
    {
        return $this->container->metaDataHelper->getAllEnabledModules();
    }

    /**
     * Schedule reindex for given modules
     * @param array $modules
     * @param boolean $clearData
     * @return boolean
     */
    protected function scheduleIndexing(array $modules, $clearData)
    {
        return $this->container->indexManager->scheduleIndexing($modules, $clearData);
    }

    /**
     * Consume all records from queue inline
     */
    protected function consumeQueue()
    {
        $this->container->queueManager->consumeQueue();
    }

    /**
     * Check if there are more records to consume
     * @return boolean
     */
    protected function hasMoreRecords()
    {
        // check the count for each module
        $queueManager = $this->container->queueManager;
        foreach ($queueManager->getQueuedModules() as $module) {
            if ($queueManager->getQueueCountModule($module) > 0) {
                return true;
            }
        }

        return false;
    }
}
