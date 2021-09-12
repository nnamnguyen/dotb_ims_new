<?php


/**
 * THIS CLASS IS GENERATED BY MODULE BUILDER
 * PLEASE DO NOT CHANGE THIS CLASS
 * PLACE ANY CUSTOMIZATIONS IN pmse_BpmnParticipant
 */
class pmse_BpmnParticipant_dotb extends Basic {
	var $new_schema = true;
	var $module_dir = 'pmse_Project/pmse_BpmnParticipant';
    public $module_name = 'pmse_BpmnParticipant';
	var $object_name = 'pmse_BpmnParticipant';
	var $table_name = 'pmse_bpmn_participant';
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
    var $par_uid;
    var $prj_id;
    var $pro_id;
    var $lns_id;
    var $par_minimum;
    var $par_maximum;
    var $par_num_participants;
    var $par_is_horizontal;


	public function __construct(){
		parent::__construct();
	}
}
