<?php

/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
$viewdefs['DRI_Workflow_Templates']['base']['view']['recordlist']['selection'] = array(
    'type' => 'multi',
    'actions' => array(
        array(
            'name' => 'massupdate_button',
            'type' => 'button',
            'label' => 'LBL_MASS_UPDATE',
            'primary' => true,
            'events' => array(
                'click' => 'list:massupdate:fire',
            ),
            'acl_action' => 'massupdate',
        ),
        array(
            'name' => 'calc_field_button',
            'type' => 'button',
            'label' => 'LBL_UPDATE_CALC_FIELDS',
            'events' => array(
                'click' => 'list:updatecalcfields:fire',
            ),
            'acl_action' => 'massupdate',
        ),
        array(
            'name' => 'massdelete_button',
            'type' => 'button',
            'label' => 'LBL_DELETE',
            'acl_action' => 'delete',
            'primary' => true,
            'events' => array(
                'click' => 'list:massdelete:fire',
            ),
        ),
    ),
);
