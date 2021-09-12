<?php




class ext_rest_zoominfoperson_filter extends default_filter {	
	
public function getList($args, $module) {
	if(empty($args)) {
	   return null;	
	}

	$list = $this->_component->getSource()->getList($args, $module);
	if(empty($list) && isset($args['companyName'])) {
	   if(preg_match('/^(.*?)([\,|\s]+.*?)$/', $args['companyName'], $matches)) {
	   	 $GLOBALS['log']->info("ext_rest_zoominfoperson_filter, change companyName search term");
	   	 $args['companyName'] = $matches[1];
	     $list = $this->_component->getSource()->getList($args, $module);
	   }
	} 		
	
	//If count was 0 and state and/or country value was used, we try to improve searching
	if(empty($list) && isset($args['EmailAddress']) && isset($args['lastName'])) {
	   $GLOBALS['log']->info("ext_rest_zoominfoperson_filter, unset lastName search term");
	   unset($args['lastName']);	
	   $list = $this->_component->getSource()->getList($args, $module);
	}	
	
	if(empty($list) && isset($args['EmailAddress']) && isset($args['firstName'])) {
	   $GLOBALS['log']->info("ext_rest_zoominfoperson_filter, unset firstName search term");
	   unset($args['firstName']);	
	   $list = $this->_component->getSource()->getList($args, $module);
	} 
	
	if(empty($list) && isset($args['EmailAddress']) && isset($args['companyName'])) {
	   unset($args['companyName']);
	   $GLOBALS['log']->info("ext_rest_zoominfoperson_filter, unset companyName search term");
	   $list = $this->_component->getSource()->getList($args, $module);
	} 		
	return $list;
}
	
}

?>
