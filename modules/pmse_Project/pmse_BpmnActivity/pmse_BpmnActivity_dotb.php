<?php


/**
 * THIS CLASS IS GENERATED BY MODULE BUILDER
 * PLEASE DO NOT CHANGE THIS CLASS
 * PLACE ANY CUSTOMIZATIONS IN pmse_BpmnActivity
 */
class pmse_BpmnActivity_dotb extends Basic {
	var $new_schema = true;
	var $module_dir = 'pmse_Project/pmse_BpmnActivity';
    public $module_name = 'pmse_BpmnActivity';
	var $object_name = 'pmse_BpmnActivity';
	var $table_name = 'pmse_bpmn_activity';
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
    var $act_uid;
    var $prj_id;
    var $pro_id;
    var $act_type;
    var $act_is_for_compensation;
    var $act_start_quantity;
    var $act_completion_quantity;
    var $act_task_type;
    var $act_implementation;
    var $act_instantiate;
    var $act_script_type;
    var $act_script;
    var $act_loop_type;
    var $act_test_before;
    var $act_loop_maximum;
    var $act_loop_condition;
    var $act_loop_cardinality;
    var $act_loop_behavior;
    var $act_is_adhoc;
    var $act_is_collapsed;
    var $act_completion_condition;
    var $act_ordering;
    var $act_cancel_remaining_instances;
    var $act_protocol;
    var $act_method;
    var $act_is_global;
    var $act_referer;
    var $act_default_flow;
    var $act_master_diagram;


	public function __construct(){
		parent::__construct();
	}
}
