<?php


namespace Dotbcrm\Dotbcrm\Console\Command\Elasticsearch;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Dotbcrm\Dotbcrm\Elasticsearch\Queue\QueueManager;
use Dotbcrm\Dotbcrm\SearchEngine\SearchEngine;
use Dotbcrm\Dotbcrm\SearchEngine\Engine\Elastic;
use Dotbcrm\Dotbcrm\Elasticsearch\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;
use Symfony\Component\Process;

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
class SilentReindexMultiProcessCommand extends Command implements InstanceModeInterface
{
    const DEFAULT_NUMBER_OF_PROCESSES = 10;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('search:silent_reindex_mp')
            ->setDescription('Create mappings and index the data using multi-processing')
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
            ->addOption(
                'processes',
                null,
                InputOption::VALUE_REQUIRED,
                'number of processes to do indexing.'
            )
            ->addOption(
                'bucket',
                null,
                InputOption::VALUE_REQUIRED,
                'the bucket id to do indexing.'
            )
        ;
    }

    /**
     * {inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $engine = SearchEngine::getInstance()->getEngine();

        if (!$engine instanceof Elastic) {
            throw new RuntimeException("Backend search engine is not Elastic");
        }

        $this->container = $engine->getContainer();

        $allModules = $this->getAllModules();
        if ($input->getOption('modules')) {
            $modules = explode(',', $input->getOption('modules'));
            foreach ($modules as $module) {
                if (!in_array($module, $allModules)) {
                    throw new RuntimeException("Invalid module name: $module");
                }
            }
        } else {
            $modules = $allModules;
        }

        if ($input->getOption('processes')) {
            $numProcesses = $input->getOption('processes');
        } else {
            $numProcesses = self::DEFAULT_NUMBER_OF_PROCESSES;
        }

        if ($numProcesses <= 0 || $numProcesses > 100) {
            throw new RuntimeException("the number of processes is out of range (1, 100): $numProcesses");
        }

        $bucketId = -1;
        if ($input->getOption('bucket')) {
            $bucketId = $input->getOption('bucket');
            if ($bucketId <= 0 || $bucketId > 100) {
                throw new RuntimeException("the bucket ID is out of range (1, 100): $bucketId");
            }
        }

        $clearData = (bool) $input->getOption('clearData');

        if ($bucketId > 0) {
            $start = time();
            // run indivdual process for $bucketId
            $this->writeln("bucket $bucketId: starting consuming fts_queue ...");
            $total = $this->consumeQueueForBucketId($bucketId);
            $duration = time() - $start;
            $this->writeln("bucket $bucketId: reindexing is completed, total records: $total; duration: $duration");
        } else {
            $start = time();
            // set Elastic mapping and fill up fts_queue
            $this->writeln("Setup elastic indices ...");
            if ($this->setupElastic($modules, $clearData)) {
                // disable refresh rate and replica
                $this->disableRefreshAndReplicas($modules);

                // create FTS queue
                $this->createFTSQueue($modules, $numProcesses);

                $duration = time() - $start;
                $this->writeln("Finished elastic mapping and fts queue, duration: $duration");
                $this->writeln("Consuming queue using $numProcesses processors, please be patient ...");
                $thisCommandName = $this->getName();

                // create commands
                for ($bucketId = 1; $bucketId <= $numProcesses; $bucketId++) {
                    $commandStr = '.' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'dotbcrm';
                    $commandStr .= " $thisCommandName  --bucket " . escapeshellarg($bucketId);
                    if ($input->getOption('modules')) {
                        $commandStr .= ' --modules ' . escapeshellarg($input->getOption('modules'));
                    }

                    $this->writeln("execute command: $commandStr");
                    $processes[] = new Process\Process($commandStr);
                }

                // start processes
                foreach ($processes as $process) {
                    $process->start();
                }

                // check results
                $count = count($processes);
                while ($count > 0) {
                    foreach ($processes as $id => $process) {
                        if (!$process->isRunning()) {
                            $bucketId = $id + 1;
                            $this->writeln("process: $bucketId");
                            $this->writeln($process->getOutput());
                            unset($processes[$id]);
                            $count--;
                        }
                    }
                    if ($count === 0) {
                        break;
                    }
                    sleep(5);
                }
            } else {
                throw new RuntimeException("something is wrong, check dotbcrm.log");
            }
            $duration = time() - $start;
            $this->writeln("Reindexing complete, duration: $duration seconds");
            $this->enableRefreshAndReplicas($modules);
        }
    }

    /**
     * write formated output
     * @param OutputInterface $output
     * @param string $msg
     */
    protected function writeln(string $msg)
    {
        $this->output->writeln(date("Y-m-d H:i:s") . ": " . $msg);
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
     * Set up elastic mapping reindex for given modules
     * @param array $modules
     * @param boolean $clearData
     * @return boolean
     */
    protected function setupElastic(array $modules, $clearData)
    {
        // set elastic mapping, but don't schedule reindexing
        return $this->container->indexManager->checkAndSyncIndices($modules, $clearData);
    }

    /**
     * Queue all records for given modules.
     * @param array $modules
     */
    protected function createFTSQueue(array $modules, int $bucketSize)
    {
        $this->container->queueManager->createQueueForBuckets($modules, $bucketSize);
    }

    /**
     * enable Elastic's refresh and replica
     * @param array $modules
     */
    protected function enableRefreshAndReplicas(array $modules)
    {
        $this->container->indexManager->enableRefresh($modules);
        $this->container->indexManager->enableReplicas($modules);
    }

    /**
     * disable Elastic's refresh and replica
     * @param array $modules
     */
    protected function disableRefreshAndReplicas(array $modules)
    {
        $this->container->indexManager->disableRefresh($modules);
        $this->container->indexManager->disableReplicas($modules);
    }

    /**
     * consume Queue for a given bucketId, it fetches data from fts_queue using bucketId and send to Elastic
     *
     * @param int $bucketId
     *
     * @return int, total records processed
     */
    protected function consumeQueueForBucketId(int $bucketId)
    {
        return $this->container->queueManager->consumeAllDataFromQueue($bucketId);
    }
}
