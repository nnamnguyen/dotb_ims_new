<?php



$module_name = 'pmse_Inbox';
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