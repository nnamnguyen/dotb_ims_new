<?php


class TemplatePhone extends TemplateText{
    var $max_size = 25;
    var $type='phone';
    var $supports_unified_search = true;
    
    /**
     * __construct
     * 
     * Constructor for TemplatePhone class. This constructor ensures that TemplatePhone instances have the
     * validate_usa_format vardef value.
     */
    public function __construct()
	{
	}	
	
	/**
	 * get_field_def
	 * 
	 * @see parent::get_field_def
	 * This method checks to see if the validate_usa_format key/value entry should be
	 * added to the vardef entry representing the module
	 */	
    function get_field_def(){
		$def = parent::get_field_def();
		$def['dbType'] = 'varchar';
		
		return $def;	
	}
}


?>
