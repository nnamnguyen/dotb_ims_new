<?php


use Dotbcrm\Dotbcrm\ProcessManager;

/**
 * Class DotbJobSendAWFEmail
 */
class DotbJobSendAWFEmail implements RunnableSchedulerJob
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
     * Executes a job to send queued emails for Advanced Workflow
     * @param string $data Json string containing the ID of the Email Message bean
     * @return bool
     */
    public function run($data)
    {
        try {
            if (!empty($data)) {
                $data = json_decode($data, true);

                if (!empty($data) && !empty($data['id'])) {
                    $id = $data['id'];

                    $emailHandler = ProcessManager\Factory::getPMSEObject('PMSEEmailHandler');
                    $emailData = $emailHandler->getQueuedEmail($id);

                    if (empty($emailData->id)) {
                        $this->job->failJob('Email Data for ID ' . $id . ' could not be found.');
                        return false;
                    }

                    if ($emailHandler->sendEmailFromQueue($emailData)) {
                        $emailData->mark_deleted($id);
                    } else {
                        $this->job->failJob('Failed to send email for pmse_EmailMessage with ID: ' . $id);
                        return false;
                    }
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
