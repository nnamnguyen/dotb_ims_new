<?php



$viewdefs['Cases']['portal']['view']['list'] = array(
    'panels' =>
    array(
        0 =>
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' =>
            array(
                array(
                    'name' => 'case_number',
                    'label' => 'LBL_LIST_NUMBER',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
                array(
                    'name' => 'name',
                    'link' => true,
                    'label' => 'LBL_LIST_SUBJECT',
                    'enabled' => true,
                    'default' => true
                ),
                array(                 
                    'name' => 'status',
                    'label' => 'LBL_LIST_STATUS',
                    'enabled' => true,
                    'default' => true
                ),
                array(
                    'name' => 'priority',
                    'label' => 'LBL_LIST_PRIORITY',
                    'enabled' => true,
                    'default' => true
                ),
                array(               
                    'name' => 'type',
                    'label' => 'LBL_TYPE',
                    'enabled' => true,
                    'default' => true
                ),
                array (
                    'name' => 'date_entered',
                    'label' => 'LBL_LIST_DATE_CREATED',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
            ),
        ),
    ),
    'last_state' => array(
        'id' => 'list',
    ),
);

