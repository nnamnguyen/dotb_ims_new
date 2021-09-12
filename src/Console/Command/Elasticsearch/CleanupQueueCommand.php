<?php


namespace Dotbcrm\Dotbcrm\Console\Command\Elasticsearch;

use Dotbcrm\Dotbcrm\Console\CommandRegistry\Mode\InstanceModeInterface;
use Dotbcrm\Dotbcrm\SearchEngine\SearchEngine;
use Dotbcrm\Dotbcrm\SearchEngine\Engine\Elastic;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use RuntimeException;

/**
 *
 * Cleanup Elasticsearch fts_queue table
 *
 */
class CleanupQueueCommand extends Command implements InstanceModeInterface
{
    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('elastic:queue_cleanup')
            ->setDescription('Cleanup records from Elasticsearch queue.')
            ->addOption(
                'modules',
                null,
                InputOption::VALUE_REQUIRED,
                'Comma separated list of modules to be purged from queue. If no module(s) are specified ' .
                'all records from any disabled modules will be purged.'
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

        $modules = explode(',', $input->getOption('modules'));

        if (empty($modules)) {
            $engine->getContainer()->queueManager->cleanupQueue();
        } else {
            $engine->getContainer()->queueManager->resetQueue($modules);
        }
    }
}
