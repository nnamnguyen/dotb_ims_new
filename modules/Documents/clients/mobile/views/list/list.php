<?php


$viewdefs['Documents']['mobile']['view']['list'] = array(
    'panels' => array (
        array (
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_DOC_NAME',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'active_date',
                    'label' => 'LBL_DATE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'category_id',
                    'label' => 'LBL_CATEGORY',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
    	),
	),
);