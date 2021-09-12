<?php



$module_name = 'pmse_Inbox';
$viewdefs[$module_name]['base']['layout']['reassignCases-list'] = array(
    'components' => array(
        array(
            'view' => 'reassignCases-list',
            'primary' => true,
        ),
        array(
            'view' => 'list-bottom',
        ),
    ),
);
