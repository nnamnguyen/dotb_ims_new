<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


class DotbLogStore implements Store {
    
    public function flush($monitor) {
       $metrics = $monitor->getMetrics();
       $values = array();
       foreach($metrics as $name=>$metric) {
       	  if(!empty($monitor->$name)) {
       	  	 $values[$name] = $monitor->$name;
       	  }
       } //foreach
       
       if(empty($values)) {
       	  return;
       }
       
       $GLOBALS['log']->info("---- metrics for $monitor->name ----");
       $GLOBALS['log']->info(var_export($values, true));
    }
}
?>
