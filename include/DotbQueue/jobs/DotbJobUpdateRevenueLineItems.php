<?php



/**
 * DotbJobUpdateRevenueLineItems.php
 *

 */
class DotbJobUpdateRevenueLineItems implements RunnableSchedulerJob
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
     * @param $data
     * @return bool
     */
    public function run($data)
    {
        $this->job->runnable_ran = true;
        $this->job->runnable_data = $data;

        $keys = json_decode(html_entity_decode($data), true);

        foreach ($keys as $key) {
            /* @var $opp RevenueLineItem */
            $opp = BeanFactory::newBean('RevenueLineItems');
            $opp->retrieve($key);
            $opp->save(false);
        }

        $this->job->succeedJob();
        return true;
    }

    /**
     * This methods schedules the Jobs
     *
     * @param int $perJob
     * @return array|mixed
     */
    public static function scheduleRevenueLineItemUpdateJobs($perJob = 100)
    {
        /* @var $db DBManager */
        $db = DBManagerFactory::getInstance();
        // get all the opps to break into groups of 100 and go newest to oldest
        $sql = "select id from revenue_line_items where deleted = 0 ORDER BY date_modified DESC;";
        $results = $db->query($sql);

        $jobs = array();

        $toProcess = array();
        while ($row = $db->fetchRow($results)) {
            $toProcess[] = $row['id'];

            if (count($toProcess) == $perJob) {
                $jobs[] = static::createJob($toProcess);
                $toProcess = array();
            }
        }

        if (!empty($toProcess)) {
            $jobs[] = static::createJob($toProcess);
        }

        // if only one job was created, just return that id
        if (count($jobs) == 1) {
            return array_shift($jobs);
        }

        return $jobs;
    }

    /**
     * Create the job in the job_queue
     *
     * @param $data
     * @return String
     */
    public static function createJob($data)
    {
        global $current_user;

        //Create an entry in the job queue to run UpdateOppsJob which handles updating all opportunities
        /* @var $job SchedulersJob */
        $job = BeanFactory::newBean('SchedulersJobs');
        $job->name = "Resave All RevenueLineItems";
        $job->target = "class::DotbJobUpdateRevenueLineItems";
        $job->data = json_encode($data);
        $job->retry_count = 0;
        $job->assigned_user_id = $current_user->id;
        $job_queue = new DotbJobQueue();
        return $job_queue->submitJob($job);
    }
}
