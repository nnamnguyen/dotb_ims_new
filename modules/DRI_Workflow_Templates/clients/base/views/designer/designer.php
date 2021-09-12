<?php

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
$viewdefs['DRI_Workflow_Templates']['base']['view']['designer'] = array (
    'template' => 'dri-workflow',
    'activityButtons' => array (
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'notCustomButton' => true,
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-pencil icon-pencil',
                    'name' => 'activity_template_edit_button',
                    'event' => 'activity:edit_button:click',
                    'tooltip' => 'LBL_EDIT_BUTTON_TITLE',
                    'acl_action' => 'edit',
                    'label' => ' ',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-eye icon-eye-open',
                    'name' => 'activity_template_preview_button',
                    'event' => 'activity:preview_button:click',
                    'label' => 'LBL_PREVIEW',
                    'acl_action' => 'view',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-user icon-user',
                    'name' => 'activity_template_add_sub_task_button',
                    'event' => 'stage:add_sub_task_button:click',
                    'acl_action' => 'edit',
                    'acl_module' => 'Tasks',
                    'label' => 'LBL_ADD_SUB_TASK_BUTTON_TITLE',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-calendar icon-calendar',
                    'name' => 'activity_template_add_sub_meeting_button',
                    'event' => 'stage:add_sub_meeting_button:click',
                    'acl_action' => 'edit',
                    'acl_module' => 'Meetings',
                    'label' => 'LBL_ADD_SUB_MEETING_BUTTON_TITLE',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-phone icon-phone',
                    'name' => 'activity_template_add_sub_call_button',
                    'event' => 'stage:add_sub_call_button:click',
                    'acl_action' => 'edit',
                    'acl_module' => 'Calls',
                    'label' => 'LBL_ADD_SUB_CALL_BUTTON_TITLE',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-times icon-remove',
                    'name' => 'activity_template_delete_button',
                    'event' => 'activity:delete_button:click',
                    'acl_action' => 'edit',
                    'label' => 'LBL_DELETE_BUTTON_TITLE',
                ),
            ),
        ),
    ),
    'activityChildButtons' => array (
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'notCustomButton' => true,
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-pencil icon-pencil',
                    'name' => 'activity_edit_button',
                    'event' => 'activity:edit_button:click',
                    'tooltip' => 'LBL_EDIT_BUTTON_TITLE',
                    'acl_action' => 'edit',
                    'label' => ' ',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-eye icon-eye-open',
                    'name' => 'activity_preview_button',
                    'event' => 'activity:preview_button:click',
                    'label' => 'LBL_PREVIEW',
                    'acl_action' => 'view',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-times icon-remove',
                    'name' => 'activity_delete_button',
                    'event' => 'activity:delete_button:click',
                    'acl_action' => 'edit',
                    'label' => 'LBL_DELETE_BUTTON_TITLE',
                ),
            ),
        ),
    ),
    'stageButtons' => array (
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'notCustomButton' => true,
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-pencil icon-pencil',
                    'name' => 'stage_template_edit_button',
                    'event' => 'stage:edit_button:click',
                    'tooltip' => 'LBL_EDIT_BUTTON_TITLE',
                    'acl_action' => 'edit',
                    'label' => ' ',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-user icon-user',
                    'name' => 'stage_template_add_task_button',
                    'event' => 'stage:add_task_button:click',
                    'acl_action' => 'edit',
                    'acl_module' => 'DRI_Workflow_Task_Templates',
                    'label' => 'LBL_ADD_TASK_BUTTON_TITLE',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-calendar icon-calendar',
                    'name' => 'stage_template_add_meeting_button',
                    'event' => 'stage:add_meeting_button:click',
                    'acl_action' => 'edit',
                    'acl_module' => 'DRI_Workflow_Task_Templates',
                    'label' => 'LBL_ADD_MEETING_BUTTON_TITLE',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-phone icon-phone',
                    'name' => 'stage_template_add_call_button',
                    'event' => 'stage:add_call_button:click',
                    'acl_action' => 'edit',
                    'acl_module' => 'DRI_Workflow_Task_Templates',
                    'label' => 'LBL_ADD_CALL_BUTTON_TITLE',
                ),
                array(
                    'type' => 'rowaction',
                    'icon' => 'fa-times icon-remove',
                    'name' => 'stage_template_delete_button',
                    'event' => 'stage:delete_button:click',
                    'acl_action' => 'delete',
                    'label' => 'LBL_DELETE_STAGE_BUTTON_TITLE',
                ),
            ),
        ),
    ),
    'topButtons' => array (
        array(
            'type' => 'actiondropdown',
            'name' => 'main_dropdown',
            'buttons' => array(
                array(
                    'type' => 'rowaction',
                    'name' => 'journey_add_stage_button',
                    'event' => 'journey:add_stage_button:click',
                    'acl_action' => 'edit',
                    'acl_module' => 'DRI_SubWorkflow_Templates',
                    'label' => 'LBL_ADD_STAGE_BUTTON_TITLE',
                ),
            ),
        ),
    ),
    'last_state' => array (
        'id' => 'dri-workflow-template',
        'defaults' => array (
            'show_more' => 'more'
        ),
    ),
);
