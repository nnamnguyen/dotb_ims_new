<?php


$viewdefs['Documents']['mobile']['view']['edit'] = array(
    'templateMeta' => array(
        'maxColumns' => '1',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
            array('label' => '10', 'field' => '30')
        ),
    ),
    'panels' => array (
        array (
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                'document_name',
                'category_id',
                'subcategory_id',
                'status_id',
                'active_date',
                'exp_date',
                'assigned_user_name',
                'team_name',
            ),
        ),
    ),
);
