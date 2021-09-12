<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


class TrackerQuery extends DotbBean {

    var $module_dir = 'Trackers';
    var $module_name = 'TrackerQueries';
    var $object_name = 'tracker_queries';
    var $table_name = 'tracker_queries';
    var $acltype = 'TrackerQuery';
    var $acl_category = 'TrackerQueries';
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
