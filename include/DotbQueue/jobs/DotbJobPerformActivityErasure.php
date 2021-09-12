<?php



class DotbJobPerformActivityErasure implements RunnableSchedulerJob
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
     * @param string $data Json string containing associative array of DataPrivacy ids to process.
     * @return bool
     */
    public function run($data)
    {
        try {
            if (!empty($data)) {
                $data = json_decode(html_entity_decode($data), true);
                if (!empty($data) && !empty($data['dataPrivacyIds'])) {
                    $dataPrivacyIds = $data['dataPrivacyIds'];

                    Activity::disable();
                    $activityErasure = new ActivityErasure();
                    $activityErasure->process($dataPrivacyIds);
                    Activity::restoreToPreviousState();
                }
            }

            $this->job->succeedJob();

            return true;
        } catch (Exception $e) {
            $this->job->failJob($e->getMessage());
            return false;
        }
    }
}
