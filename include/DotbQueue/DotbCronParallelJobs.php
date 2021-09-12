<?php



/**
 * CRON driver for job queue that forks a process for each job
 * @api
 */
class DotbCronParallelJobs extends DotbCronJobs
{
    public $allow_fork = true;

    public function runShell($job)
    {

        // Beware of PHP bug #60185 - maybe problematic here, though works fine on my tests.
        global $dotb_config;
        chdir(dirname(__FILE__). "/../../");
        $command = sprintf("nohup %s -f run_job.php %s %s 1>/dev/null 2>/dev/null &", $dotb_config['cron']['php_binary'], $job->id, $this->getMyId());
        shell_exec($command);
        return true;
    }

    protected function fail($job, $message)
    {
        $job->failJob($message);
        $this->jobFailed($job);
    }

    protected function forkJob($job)
    {
        DBManagerFactory::disconnectAll();
        $pid = pcntl_fork();

        if($pid) {
            // parent - reconnect and exit
            $GLOBALS['db'] = DBManagerFactory::getInstance();
            $GLOBALS['log']->debug('After fork - parent');
            return;
        } else {
          // the child process
          $GLOBALS['log']->debug('After fork - child');
          $sid = posix_setsid();
          if($sid < 0) {
              $this->fail($job, "Could not change session ID");
          }
          // Reestablish DB connections after fork
          $GLOBALS['db'] = DBManagerFactory::getInstance();
          parent::executeJob($job);
          $this->job = null;
          exit(0);
        }
    }

    protected function checkPHPBinary($job)
    {
        global $dotb_config;
        if(empty($dotb_config['cron']['php_binary']) || !file_exists($dotb_config['cron']['php_binary'])) {
            $this->fail($job, "PHP binary not set, please set \$dotb_config['cron']['php_binary']");
            return false;
        }
        return true;
    }

    protected function runWindows($job)
    {
        if(!$this->checkPHPBinary($job)) {
            return;
        }
        if(!extension_loaded("COM")) {
            $this->fail("Cannot run PHP binary, please enable COM extension");
        }
        $WshShell = new COM("WScript.Shell");
        chdir(dirname(__FILE__). "/../../");
        $command = sprintf("%s -f run_job.php %s %s", $dotb_config['cron']['php_binary'], $job->id, $this->getMyId());
        $WshShell->Run($command, 0, false); // no window, don't wait for return
        $WshShell->Release();
    }

    /**
     * Execute given job
     * @param SchedulersJob $job
     */
    public function executeJob($job)
    {
        if(stripos(PHP_OS, "win") !== false && stripos(PHP_OS, "darwin") === false) {
            // windows
            $this->runWindows($job);
            return;
        }
        if($this->allow_fork && function_exists("pcntl_fork") && function_exists("posix_setsid")) {
            $this->forkJob($job);
            return;
        }
        if(!$this->checkPHPBinary($job)) {
            return;
        }
        if(!$this->runShell($job)) {
            $this->fail($job, "Could not launch job {$job->id}");
        }
    }

}

