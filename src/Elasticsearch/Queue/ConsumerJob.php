<?php


namespace Dotbcrm\Dotbcrm\Elasticsearch\Queue;

use Dotbcrm\Dotbcrm\SearchEngine\SearchEngine;


/**
 *
 * Handle the consumption of records from the database queue.
 *
 */
class ConsumerJob implements \RunnableSchedulerJob
{
    /**
     * @var \SchedulersJob
     */
    protected $job;

    /**
     * @var \Dotbcrm\Dotbcrm\SearchEngine\Engine\Elastic
     */
    protected $engine;

    /**
     * Ctor
     * @param SearchEngineInterface $engine
     */
    public function __construct(SearchEngine $engine = null)
    {
        $this->engine = $engine ?: SearchEngine::getInstance();
    }

    /**
     * {@inheritdoc}
     */
    public function setJob(\SchedulersJob $job)
    {
        $this->job = $job;
    }

    /**
     * {@inheritdoc}
     */
    public function run($module)
    {
        // We can only run for Elasticsearch engine
        if (!$this->isElasticSearchEngine()) {
            return $this->job->failJob("The current configured SearchEngine is not Elasticsearch");
        }

        // The passed in data is expected to contain the module name
        if (empty($module)) {
            return $this->job->failJob("Missing module parameter");
        }

        // Force connectivity check
        if (!$this->engine->isAvailable(true)) {
            $msg = 'SearchEngine not available, postponing execution';
            return $this->job->postponeJob($msg);
        }

        list($success, $processed, $duration, $errorMsg) = $this->consumeModuleFromQueue($module);

        $msg = sprintf("Processed %s records in %s second(s)", $processed, $duration);
        if ($success) {
            return $this->job->succeedJob($msg);
        } else {
            $msg .= sprintf(" with error '%s'", $errorMsg);
            return $this->job->failJob($msg);
        }
    }

    /**
     * Check if current active engine is for elasticsearch
     * @return boolean
     */
    protected function isElasticSearchEngine()
    {
        return ($this->engine->getEngine() instanceof \Dotbcrm\Dotbcrm\SearchEngine\Engine\Elastic);
    }

    /**
     * Consume queue for givem nodule
     * @param string $module
     * @return array
     */
    protected function consumeModuleFromQueue($module)
    {
        return $this->engine->getContainer()->queueManager->consumeModuleFromQueue($module);
    }
}
