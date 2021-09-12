<?php


$viewdefs['Documents']['mobile']['view']['detail'] = array(
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
                array (
                    'name' => 'name',
                    'label' => 'LBL_DOC_NAME',
                ),
                'active_date',
                'category_id',
                'subcategory_id',
                'status_id',
                'team_name',
            ),
    	),
	),
);
