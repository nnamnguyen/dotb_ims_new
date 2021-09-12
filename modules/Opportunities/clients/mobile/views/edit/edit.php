<?php



$viewdefs['Opportunities']['mobile']['view']['edit'] = array(
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
                        'wireless_edit_only' => true,
                    )
                ),
                'amount',
                'account_name',
                'date_closed',
                'sales_stage',
                'probability',
                'assigned_user_name',
                'team_name',
            )
        )
    ),
);
