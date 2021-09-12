<?php
/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */

if (!defined('dotbEntry') || !dotbEntry) {
    die('Not A Valid Entry Point');
}

$viewdefs['DRI_Workflow_Task_Templates']['base']['view']['create-actions'] = array(
    'template' => 'record',
    'buttons' => array(
        array(
            'name'      => 'cancel_button',
            'type'      => 'button',
            'label'     => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-invisible btn-link',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
        array(
            'name'      => 'restore_button',
            'type'      => 'button',
            'label'     => 'LBL_RESTORE',
            'css_class' => 'btn-invisible btn-link',
            'showOn'    => 'select',
            'events' => array(
                'click' => 'button:restore_button:click',
            ),
        ),
        array(
            'type'    => 'actiondropdown',
            'name'    => 'main_dropdown',
            'primary' => true,
            'switch_on_click' => true,
            'buttons' => array(
                array(
                    'type'  => 'rowaction',
                    'name'  => 'save_button',
                    'label' => 'LBL_SAVE_BUTTON_LABEL',
                    'events' => array(
                        'click' => 'button:save_button:click',
                    ),
                ),
                array(
                    'type'   => 'rowaction',
                    'name'   => 'save_view_button',
                    'label'  => 'LBL_SAVE_AND_VIEW',
                    'showOn' => 'create',
                    'events' => array(
                        'click' => 'button:save_view_button:click',
                    ),
                ),
                array(
                    'type'   => 'rowaction',
                    'name'   => 'save_create_button',
                    'label'  => 'LBL_SAVE_AND_CREATE_ANOTHER',
                    'showOn' => 'create',
                    'events' => array(
                        'click' => 'button:save_create_button:click',
                    ),
                ),
            ),
        ),
        array(
            'name' => 'sidebar_toggle',
            'type' => 'sidebartoggle',
        ),
    ),
);
