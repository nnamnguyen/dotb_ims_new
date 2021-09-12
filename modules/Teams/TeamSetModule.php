<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
/**

 */
class TeamSetModule extends DotbBean{
    /*
    * char(36) GUID
    */
    var $id;

    var $team_set_id;
    var $module_table_name;

    var $table_name = "team_sets_modules";
    var $object_name = "TeamSetModule";
    public $module_name = 'TeamSetModules';
    var $module_dir = 'Teams';
    var $disable_custom_fields = true;

    /**
    * Default constructor
    *
    */
    public function __construct(){
        parent::__construct();
        $this->disable_row_level_security =true;
    }

    public function save($check_notify = false)
    {
        $query = "SELECT id
            FROM $this->table_name
            WHERE team_set_id = ?
                AND module_table_name = ?";
        $row = $this->db->getConnection()->fetchColumn(
            $query,
            [$this->team_set_id, $this->module_table_name]
        );
        if (!$row){
            // insert the record by means of plain SQL in order to not trigger all other logic in DotbBean::save(),
            // since this method is manually called from DotbBean::save()
            $this->db->insertParams(
                $this->table_name,
                $this->getFieldDefinitions(),
                [
                    'id' => create_guid(),
                    'team_set_id' => $this->team_set_id,
                    'module_table_name' => $this->module_table_name,
                    'deleted' => 0,
                ]
            );
        }
    }
}
