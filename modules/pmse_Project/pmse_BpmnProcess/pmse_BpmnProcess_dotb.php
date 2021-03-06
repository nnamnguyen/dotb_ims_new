<?php


/**
 * THIS CLASS IS GENERATED BY MODULE BUILDER
 * PLEASE DO NOT CHANGE THIS CLASS
 * PLACE ANY CUSTOMIZATIONS IN pmse_BpmnProcess
 */
class pmse_BpmnProcess_dotb extends Basic {
	var $new_schema = true;
	var $module_dir = 'pmse_Project/pmse_BpmnProcess';
    public $module_name = 'pmse_BpmnProcess';
	var $object_name = 'pmse_BpmnProcess';
	var $table_name = 'pmse_bpmn_process';
	var $importable = false;
    var $disable_custom_fields = true;
    var $id;
    var $name;
    var $date_entered;
    var $date_modified;
    var $modified_user_id;
    var $modified_by_name;
    var $created_by;
    var $created_by_name;
    var $description;
    var $deleted;
    var $created_by_link;
    var $modified_user_link;
    var $activities;
    var $assigned_user_id;
    var $assigned_user_name;
    var $assigned_user_link;
    var $pro_uid;
    var $prj_id;
    var $dia_id;
    var $pro_type;
    var $pro_is_executable;
    var $pro_is_closed;
    var $pro_is_subprocess;

	public function __construct(){
		parent::__construct();
	}
}
