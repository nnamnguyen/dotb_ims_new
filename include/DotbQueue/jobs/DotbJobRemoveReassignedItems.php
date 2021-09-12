<?php



/**
 * DotbJobRemoveReassignedItems
 *
 * Class to run a job which will remove any reassigned items from the forecast worksheet upon commit
 *
 */
class DotbJobRemoveReassignedItems implements RunnableSchedulerJob
{

    /**
     * @var SchedulersJob
     */
    protected $job;

    /**
     * @param SchedulersJob $job
     */
    public function setJob(SchedulersJob $job)
    {
        $this->job = $job;
    }


    /**
     * @param string $data The job data set for this particular Scheduled Job instance
     * @return boolean true if the run succeeded; false otherwise
     */
    public function run($data)
    {
        $args = json_decode(html_entity_decode($data), true);
        $this->job->runnable_ran = true;
        $fw = new ForecastWorksheet();

        $fw->processRemoveChunk($args);

        $this->job->succeedJob();
        return true;
    }

}
