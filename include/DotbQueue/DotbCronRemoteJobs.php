<?php


/**
 * CRON driver for job queue that ships jobs outside
 * @api
 */
class DotbCronRemoteJobs extends DotbCronJobs
{
    /**
     * URL for remote job server
     * @var string
     */
    protected $jobserver;

    /**
     * Just in case we'd ever need to override...
     * @var string
     */
    protected $submitURL = "submitJob";

    /**
     * REST client
     * @var string
     */
    protected $client;

    public function __construct()
    {
        parent::__construct();
        if(!empty($GLOBALS['dotb_config']['job_server'])) {
            $this->jobserver = $GLOBALS['dotb_config']['job_server'];
        }
        $this->setClient(new DotbHttpClient());
    }

    /**
    * Set client to talk to SNIP
    * @param DotbHttpClient $client
    */
    public function setClient(DotbHttpClient $client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Return ID for this client
     * @return string
     */
    public function getMyId()
    {
        return 'CRON'.$GLOBALS['dotb_config']['unique_key'].':'.md5($this->jobserver);
    }

    /**
     * Execute given job
     * @param SchedulersJob $job
     */
    public function executeJob($job)
    {
        $data = http_build_query(array("data" => json_encode(array("job" => $job->id, "client" => $this->getMyId(), "instance" => $GLOBALS['dotb_config']['site_url']))));
        $response = $this->client->callRest($this->jobserver.$this->submitURL, $data);
        if(!empty($response)) {
            $result = json_decode($response, true);
            if(empty($result) || empty($result['ok']) || $result['ok'] != $job->id) {
                $GLOBALS['log']->debug("CRON Remote: Job {$job->id} not accepted by server: $response");
                $this->jobFailed($job);
                $job->failJob("Job not accepted by server: $response");
            }
        } else {
            $GLOBALS['log']->debug("CRON Remote: REST request failed for job {$job->id}");
            $this->jobFailed($job);
            $job->failJob("Could not connect to job server");
        }
    }

}

