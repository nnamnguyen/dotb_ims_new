<?php

/*********************************************************************************
 * Description:
 ********************************************************************************/





class Holiday extends DotbBean {

	var $id;
	var $deleted;
	var $date_entered;
	var $date_modified;
	var $modified_user_id;
	var $created_by;
	var $name;
	var $holiday_date;
	var $description;
	var $person_id;
	var $person_type;
	var $related_module;
	var $related_module_id;

	var $table_name = 'holidays';
	var $object_name = 'Holiday';
	var $module_dir = 'Holidays';
	var $new_schema = true;


	public function __construct()
	{
		parent::__construct();
		$this->disable_row_level_security = true;
	}
	
	function get_summary_text()
	{
		return $this->name;
	}
}
