<?php


class tracker_monitor extends Monitor
{
    /**
     * save
     * This method retrieves the Store instances associated with monitor and calls
     * the flush method passing with the montior ($this) instance.
     * @param $flush boolean parameter indicating whether or not to flush the instance data to store or possibly cache
     */
    public function save($flush=true) {
    	//if the monitor does not have values set no need to do the work saving. 
    	if(!$this->dirty)return false;
    	
    	if(!$this->isEnabled() && (isset($this->visible) && !$this->getValue('visible'))) {
    		return false;
    	}
    	
    	if(empty($GLOBALS['tracker_' . $this->table_name])) {
    	    foreach($this->stores as $s) {
	    		$store = $this->getStore($s);
	    		$store->flush($this);
    		}
    	}
    	$this->clear();
    }

}
