<?php


$viewdefs['Products']['mobile']['view']['detail'] = array(
    'templateMeta' => array(
        'maxColumns' => '1',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
        ),
    ),
    'panels' => array(
        array(
            'fields' => array(
                'name',
                'status',
                'account_name',
                'quote_name',
                'quantity',
                'discount_price',
                'assigned_user_name',
                'team_name',
            ),
        ),
    ),
);
