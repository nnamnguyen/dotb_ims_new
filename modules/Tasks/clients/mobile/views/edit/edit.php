<?php


/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$viewdefs['Tasks']['mobile']['view']['edit'] = array(
    'templateMeta' => array(
        'maxColumns' => '1',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
        ),
    ),
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'name',
                    'displayParams' => array(
                        'required' => true,
                        'wireless_edit_only' => true)),
                'priority',
                'status',
                'date_start',
                'date_due',
                'description',
                'contact_name',
                'parent_name',
                'assigned_user_name',
                'team_name',
            )
        ),
    ),
);
?>
