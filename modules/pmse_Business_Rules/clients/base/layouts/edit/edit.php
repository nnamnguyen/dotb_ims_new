<?php



$module_name = 'pmse_Business_Rules';
$viewdefs[$module_name]['base']['layout']['edit'] = array(
    'components' => array(
        array(
            'view' => 'subnavedit',
        ),
        array(
            'view' => 'edit',
        )
    ),
);
