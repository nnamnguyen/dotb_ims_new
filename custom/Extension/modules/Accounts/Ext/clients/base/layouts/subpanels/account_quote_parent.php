<?php
$viewdefs['Accounts']['base']['layout']['subpanels']['components'][] = array (
    'layout' => 'subpanel',
    'label' => 'LBL_QUOTE_ACCOUNT_TITLE',
    'override_paneltop_view' => 'panel-top-for-quote',
    'context' =>
        array (
            'link' => 'quote_parent',
        ),
);