<?php


class ProspectsViewDetail extends ViewDetail {
 	function display() {
		if(isset($this->bean->lead_id) && !empty($this->bean->lead_id)){
			
			//get lead name
			$lead = BeanFactory::getBean('Leads', $this->bean->lead_id);
			$this->ss->assign('lead', $lead);
		}
 		parent::display();
 	}
}
