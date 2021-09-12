<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$module_name = '<module_name>';
$viewdefs[$module_name]['base']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'document_name',
                    'label' => 'LBL_NAME',
                    'link' => true,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'modified_by_name',
                    'label' => 'LBL_MODIFIED_USER',
                    'module' => 'Users',
                    'id' => 'USERS_ID',
                    'default' => false,
                    'sortable' => false,
                    'related_fields' => array('modified_user_id'),
                ),
                array(
                    'name' => 'category_id',
                    'label' => 'LBL_LIST_CATEGORY',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'subcategory_id',
                    'label' => 'LBL_LIST_SUBCATEGORY',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'team_name',
                    'label' => 'LBL_TEAM',
                    'sortable' => false,
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'created_by_name',
                    'label' => 'LBL_LIST_LAST_REV_CREATOR',
                    'default' => true,
                    'sortable' => false,
                    'enabled' => true,
                ),
                array(
                    'name' => 'active_date',
                    'label' => 'LBL_LIST_ACTIVE_DATE',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'exp_date',
                    'label' => 'LBL_LIST_EXP_DATE',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'date_modified',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_entered',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
