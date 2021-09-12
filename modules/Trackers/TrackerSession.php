<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


class TrackerSession extends DotbBean {

    var $module_dir = 'Trackers';
    var $module_name = 'TrackerSessions';
    var $object_name = 'tracker_sessions';
    var $table_name = 'tracker_sessions';
    var $acltype = 'TrackerSession';
    var $acl_category = 'TrackerSessions';
    var $disable_custom_fields = true;

    var $disable_row_level_security = true;

    function bean_implements($interface){
        switch($interface){
            case 'ACL': return true;
        }
        return false;
    }
}
?>
