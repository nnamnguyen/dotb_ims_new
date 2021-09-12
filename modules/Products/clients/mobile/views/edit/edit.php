<?php

$viewdefs['Products']['mobile']['view']['edit'] = array(
    'templateMeta' => array(
        'maxColumns' => '1',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
        ),
    ),
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' => 'name',
                    'required' => true,
                ),
                'product_template_name',
                'status',
                'account_name',
                'quote_name',
                'quantity',
                array(
                    'name' => 'discount_price',
                ),
                array(
                    'name' => 'cost_price',
                    'readonly' => true,
                ),
                array(
                    'name' => 'list_price',
                    'readonly' => true,
                ),
                array(
                    'name' => 'mft_part_num',
                    'readonly' => true,
                ),
                'assigned_user_name',
                'team_name',
            ),
        ),
    ),
);
