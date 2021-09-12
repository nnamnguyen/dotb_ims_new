<?php
/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * @package FTE Usage Tracking
 */

$viewdefs['base']['view']['custom-config'] = array(
    "fields"=>array(
        array(
            "name"=>"tracking_enabled",
            "type"=>"enum",
            "label"=>"LBL_FTE_UT_ENABLED",
            "options"=>"dom_int_bool",
        ),
        array(
            "name"=>"non_tracked_users_name",
            "type"=>"relate",
            "label"=>"LBL_FTE_UT_USERS",
            "isMultiSelect"=>true,
            "module"=>"Users",
            "link"=> "blacklisted_user_link",
            "id_name"=>"non_tracked_users_ids",
            "rname"=>"full_name",
            "source"=>"non-db"
        )
    )
);