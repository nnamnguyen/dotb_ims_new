<?php

class TemplateAddressCountry extends TemplateEnum {
    
    var $group = '';
    
	function get_field_def(){
		$def = parent::get_field_def();
		$def['group'] = $this->group;
		$def['options'] = 'countries_dom';
		return $def;	
	}
}


?>
