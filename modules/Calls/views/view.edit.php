<?php


require_once('include/json_config.php');

class CallsViewEdit extends ViewEdit
{
    /**
     * @const MAX_REPEAT_INTERVAL Max repeat interval.
     */
    const MAX_REPEAT_INTERVAL = 30;
    
 	/**
 	 * @see DotbView::preDisplay()
 	 */
 	public function preDisplay()
 	{
 		if($_REQUEST['module'] != 'Calls' && isset($_REQUEST['status']) && empty($_REQUEST['status'])) {
	       $this->bean->status = '';
 		} //if
        if(!empty($_REQUEST['status']) && ($_REQUEST['status'] == 'Held')) {
	       $this->bean->status = 'Held';
 		}
 		parent::preDisplay();
 	}

 	/**
 	 * @see DotbView::display()
 	 */
 	public function display()
 	{
 		global $json;
        $json = getJSONobj();
        $json_config = new json_config();
		if (isset($this->bean->json_id) && !empty ($this->bean->json_id)) {
			$javascript = $json_config->get_static_json_server(false, true, 'Calls', $this->bean->json_id);

		} else {
			$this->bean->json_id = $this->bean->id;
			$javascript = $json_config->get_static_json_server(false, true, 'Calls', $this->bean->id);

		}
 		$this->ss->assign('JSON_CONFIG_JAVASCRIPT', $javascript);

 		if($this->ev->isDuplicate){
	        $this->bean->status = $this->bean->getDefaultStatus();
 		} //if
 		
        $this->ss->assign('APPLIST', $GLOBALS['app_list_strings']);
        
        $repeatIntervals = array();
        for ($i = 1; $i <= self::MAX_REPEAT_INTERVAL; $i++) {
            $repeatIntervals[$i] = $i;
        }
        $this->ss->assign("repeat_intervals", $repeatIntervals);

        $fdow = $GLOBALS['current_user']->get_first_day_of_week();
        $dow = array();
        for ($i = $fdow; $i < $fdow + 7; $i++){
            $dayIndex = $i % 7;
            $dow[] = array("index" => $dayIndex , "label" => $GLOBALS['app_list_strings']['dom_cal_day_short'][$dayIndex + 1]);
        }
        $this->ss->assign('dow', $dow);
        $this->ss->assign('repeatData', json_encode($this->view_object_map['repeatData']));
 		
 		parent::display();
 	}
}
