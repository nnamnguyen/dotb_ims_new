<?php



class DotbJobAddActivitySubscriptions implements RunnableSchedulerJob
{
    protected $job;

    /**
     * This method implements setJob from RunnableSchedulerJob. It sets the
     * SchedulersJob instance for the class.
     *
     * @param SchedulersJob $job the SchedulersJob instance set by the job queue
     */
    public function setJob(SchedulersJob $job)
    {
        $this->job = $job;
    }

    /**
     * Executes a job to add activity subscriptions.
     * @param $data
     * @return bool
     */
    public function run($data)
    {
        try {
            $data                  = unserialize($data);
            $subscriptionsBeanName = BeanFactory::getBeanClass('Subscriptions');
            $subscriptionsBeanName::addActivitySubscriptions($data);
            $this->job->succeedJob();
            return true;
        } catch (Exception $e) {
            $this->job->failJob($e->getMessage());
            return false;
        }
    }
}
