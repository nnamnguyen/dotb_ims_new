<?php

/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */
$module_name = 'bc_survey_sms_template';
$viewdefs[$module_name] = array(
    'EditView' =>
    array(
        'templateMeta' =>
        array(
            'maxColumns' => '2',
            'widths' =>
            array(
                0 =>
                array(
                    'label' => '10',
                    'field' => '30',
                ),
                1 =>
                array(
                    'label' => '10',
                    'field' => '30',
                ),
            ),
            'useTabs' => false,
            'tabDefs' =>
            array(
                'DEFAULT' =>
                array(
                    'newTab' => false,
                    'panelDefault' => 'expanded',
                ),
            ),
        ),
        'panels' =>
        array(
            'default' =>
            array(
                0 =>
                array(
                    0 =>
                    array(
                        'name',
                    ),
                    1 => 'assigned_user_name',
                ),
                1 =>
                array(
                    0 =>
                    array(
                        'name' => 'sms_content',
                        'label' => 'LBL_SMS_CONTENT',
                    ),
                ),
                2 =>
                array(
                    0 =>
                    array(
                        'name' => 'sms_sync_module_list',
                        'label' => 'LBL_SMS_SYNC_MODULE_LIST',
                    ),
                    1 =>
                    array(
                        'name' => 'sms_field_name',
                        'label' => 'LBL_SMS_FIELD_NAME',
                    ),
                ),
                3 =>
                array(
                    0 => 'description',
                    1 => '',
                ),
                4 =>
                array(
                    0 => array(
                        'name' => 'team_name',
                        'displayParams' => array('display' => true)
                    ),
                    1 => ''
                ),
            ),
        ),
    ),
);
?>
