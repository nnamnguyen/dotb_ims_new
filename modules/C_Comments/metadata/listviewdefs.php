<?php

/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
 
 $module_name = 'C_Comments';
$OBJECT_NAME = 'C_COMMENTS';
 $listViewDefs[$module_name] = array(

	'DOCUMENT_NAME' => array(
		'width' => '40',
		'label' => 'LBL_NAME',
		'link' => true,
        'default' => true),
    'MODIFIED_BY_NAME' => array(
        'width' => '10',
        'label' => 'LBL_MODIFIED_USER',
        'module' => 'Users',
        'id' => 'USERS_ID',
        'default' => false,
        'sortable' => false,
        'related_fields' => array('modified_user_id')),
    'CATEGORY_ID' => array(
        'width' => '40',
        'label' => 'LBL_LIST_CATEGORY',
        'default' => true),
    'SUBCATEGORY_ID' => array(
        'width' => '40',
        'label' => 'LBL_LIST_SUBCATEGORY',
        'default' => true),
    'TEAM_NAME' => array(
        'width' => '2',
        'label' => 'LBL_LIST_TEAM',
        'default' => false,
        'sortable' => false),
    'CREATED_BY_NAME' => array(
        'width' => '2',
        'label' => 'LBL_LIST_LAST_REV_CREATOR',
        'default' => true,
        'sortable' => false),

    'ACTIVE_DATE' => array(
        'width' => '10',
        'label' => 'LBL_LIST_ACTIVE_DATE',
        'default' => true),
    'EXP_DATE' => array(
        'width' => '10',
        'label' => 'LBL_LIST_EXP_DATE',
        'default' => true),
        );
