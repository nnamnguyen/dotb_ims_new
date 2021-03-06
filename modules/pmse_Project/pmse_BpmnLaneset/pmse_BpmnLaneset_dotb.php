<?php


/**
 * THIS CLASS IS GENERATED BY MODULE BUILDER
 * PLEASE DO NOT CHANGE THIS CLASS
 * PLACE ANY CUSTOMIZATIONS IN pmse_BpmnLaneset
 */
class pmse_BpmnLaneset_dotb extends Basic {
	var $new_schema = true;
	var $module_dir = 'pmse_Project/pmse_BpmnLaneset';
    public $module_name = 'pmse_BpmnLaneset';
	var $object_name = 'pmse_BpmnLaneset';
	var $table_name = 'pmse_bpmn_laneset';
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
    var $lns_uid;
    var $prj_id;
    var $pro_id;
    var $lns_parent_lane;
    var $lns_is_horizontal;
    var $lns_state;

	public function __construct(){
		parent::__construct();
	}
}
