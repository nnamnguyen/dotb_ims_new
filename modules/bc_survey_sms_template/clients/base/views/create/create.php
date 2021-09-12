<?php

/**
 * The file used to set layout of create-actions
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
if (!defined('dotbEntry') || !dotbEntry) {
    die('Not A Valid Entry Point');
}

$viewdefs['bc_survey']['base']['view']['create'] = array(
    'template' => 'record',
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-invisible btn-link',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
        array(
            'name' => 'restore_button',
            'type' => 'button',
            'label' => 'LBL_RESTORE',
            'css_class' => 'btn-invisible btn-link',
            'showOn' => 'select',
            'events' => array(
                'click' => 'button:restore_button:click',
            ),
        ),
        array(
            'name' => 'save_button',
            'type' => 'button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
            'primary' => true,
            'showOn' => 'create',
            'events' => array(
                'click' => 'button:save_button:click',
            ),
        ),
    ),
    array(
        'type' => 'actiondropdown',
        'name' => 'duplicate_dropdown',
        'primary' => true,
        'showOn' => 'duplicate',
        'buttons' => array(
            array(
                'type' => 'rowaction',
                'name' => 'save_button',
                'label' => 'LBL_IGNORE_DUPLICATE_AND_SAVE',
                'events' => array(
                    'click' => 'button:save_button:click',
                ),
            ),
        ),
    ),
    array(
        'type' => 'actiondropdown',
        'name' => 'select_dropdown',
        'primary' => true,
        'showOn' => 'select',
        'buttons' => array(
            array(
                'type' => 'rowaction',
                'name' => 'save_button',
                'label' => 'LBL_SAVE_BUTTON_LABEL',
                'events' => array(
                    'click' => 'button:save_button:click',
                ),
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
                    'name' => 'sms_sync_module_list',
                    'label' => 'LBL_SMS_SYNC_MODULE_LIST',
                ),
                1 =>
                array(
                    'name' => 'sms_field_name',
                    'label' => 'LBL_SMS_FIELD_NAME',
                ),
            ),
            2 =>
            array(
                0 =>
                array(
                    'name' => 'sms_content',
                    'label' => 'LBL_SMS_CONTENT',
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
    array(
        'name' => 'sidebar_toggle',
        'type' => 'sidebartoggle',
    ),
);
