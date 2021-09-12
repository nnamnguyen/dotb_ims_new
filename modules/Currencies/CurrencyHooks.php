<?php


class CurrencyHooks
{
    /**
     * Checks to see if the conversion_rate updated on save, then schedules a job to update all the currencies in the
     * app that use them.
     * @param Currency $bean
     * @param $event
     * @param $args
     */
    public function updateCurrencyConversion(Currency $bean, $event, $args)
    {
        if ($args['isUpdate'] && $bean->fetched_row['conversion_rate'] != $bean->conversion_rate) {
            $job = $this->getSchedulersJobs();
            $job->name = 'DotbJobUpdateCurrencyRates: ' . $bean->id;
            $job->target = 'class::DotbJobUpdateCurrencyRates';
            $job->data = $bean->id;
            $job->retry_count = 0;
            $job->assigned_user_id = $bean->modified_user_id;
            $jobQueue = $this->getDotbJobQueue();
            $jobQueue->submitJob($job);
        }
    }

    /**
     * gets a new instance of the SchedulersJobs bean
     * @return null|DotbBean
     */
    protected function getSchedulersJobs()
    {
        return BeanFactory::newBean('SchedulersJobs');
    }

    /**
     * gets a new instance of the DotbJobQueue
     * @return DotbJobQueue
     */
    protected function getDotbJobQueue()
    {
        return new DotbJobQueue();
    }
}
