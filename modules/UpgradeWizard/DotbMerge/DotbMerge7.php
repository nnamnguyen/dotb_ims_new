<?php


/**
 *
 * This is a hack needed because in 6.5 DotbMerge tried to load upgraders from new path
 * but new upgraders are not compatible with old code
 *
 */
class DotbMerge7 extends DotbMerge
{
    protected $upgrader;

    public function setUpgrader($u)
    {
        $this->upgrader = $u;
        if(!empty($u->fp)) {
            $this->setLogFilePointer($u->fp);
        }
    }

    public function getNewPath()
    {
        // HACK, see above
        return '';
    }

    /**
     * Override so that we would have better logging
     * @see DotbMerge::createHistoryLog()
     */
    protected function createHistoryLog($module,$customFile,$file)
    {
        $historyPath = 'custom/' . MB_HISTORYMETADATALOCATION . "/modules/$module/metadata/$file";
        $history = new History($historyPath);
        $timeStamp = $history->append($customFile);
        $this->log("Created history file after merge with new file: " . $historyPath .'_'.$timeStamp);
    }

    /**
     * Log a message
     * @param string $message
     */
    protected function log($message)
    {
        if($this->upgrader) {
            $this->upgrader->log($message);
        }
    }

}


