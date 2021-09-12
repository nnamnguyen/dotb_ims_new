<?php

$viewdefs['Cases']['mobile']['view']['edit'] = array(
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
                    'name' => 'case_number',
                    'displayParams' => array(
                        'required' => false,
                        'wireless_detail_only' => true,
                    )
                ),
                array('name' => 'name',
                    'displayParams' => array(
                        'required' => true,
                        'wireless_edit_only' => true,
                    )
                ),
                'account_name',
                'priority',
                'status',
                'description',
                'resolution',
                'assigned_user_name',

                'team_name',
            ),
        )
    )
);
?>
