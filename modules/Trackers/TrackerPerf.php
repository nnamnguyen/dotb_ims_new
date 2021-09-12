<?php

/*********************************************************************************

 * Description:  TODO: To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/


class TrackerPerf extends DotbBean {

    var $module_dir = 'Trackers';
    var $object_name = 'tracker_perf';
    var $module_name = 'TrackerPerfs';
    var $table_name = 'tracker_perf';
    var $acltype = 'TrackerPerf';
    var $acl_category = 'TrackerPerfs';
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
