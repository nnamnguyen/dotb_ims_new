<?php




class ext_rest_zoominfocompany_filter extends default_filter {	
	
public function getList($args, $module) {
	
	if(empty($args)) {
	   return null;	
	}

	$list = $this->_component->getSource()->getList($args, $module);

	if(empty($list) && isset($args['companyName'])) {
	   if(preg_match('/^(.*?)([\,|\s]+.*?)$/', $args['companyName'], $matches)) {
	   	 $GLOBALS['log']->info("ext_rest_zoominfocompany_filter, change companyName search term");
	   	 $args['companyName'] = $matches[1];
	     $list = $this->_component->getSource()->getList($args, $module);
	   }
	} 			
	
	//If count was 0 and state and/or country value was used, we try to improve searching
	if(empty($list) && isset($args['companyName']) && isset($args['ZipCode'])) {
	   $GLOBALS['log']->info("ext_rest_zoominfocompany_filter, unset ZipCode search term");
	   unset($args['ZipCode']);	
	   $list = $this->_component->getSource()->getList($args, $module);
	}	
	
	if(empty($list) && isset($args['companyName']) && isset($args['Country'])) {
	   $GLOBALS['log']->info("ext_rest_zoominfocompany_filter, unset Country search term");
	   unset($args['Country']);	
	   $list = $this->_component->getSource()->getList($args, $module);
	} 

	return $list;
}
	
}

?>
