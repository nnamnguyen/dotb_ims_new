<?php



$module_name = 'pmse_Project';
$viewdefs[$module_name]['base']['layout']['detail'] = array(
    'components' => array(
        array(
            'view' => 'subnavdetail',
        ),
        array(
            'view' => 'detail',
        ),
    ),
);
