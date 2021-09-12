<?php












/**
 *
 */
class ProjectResource extends DotbBean {
	// database table columns
	var $id;
	var $date_modified;
	var $assigned_user_id;
	var $modified_user_id;
	var $created_by;

	var $team_id;
	var $deleted;

	// related information
	var $modified_by_name;
	var $created_by_name;

	var $team_name;

	var $project_id;
	var $resource_id;
	var $resource_type;
	
	var $object_name = 'ProjectResource';
	var $module_dir = 'ProjectResources';
	var $new_schema = true;
	var $table_name = 'project_resources';
}
