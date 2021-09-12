<?php



$viewdefs['pmse_Emails_Templates']['base']['layout']['compose-varbook-list'] = array(
    'type' => 'multi-selection-list',
    'components' => array(
        array(
            'view' => 'compose-varbook-list',
        ),
        array(
            'view' => 'compose-varbook-list-bottom',
        ),
    ),
);
