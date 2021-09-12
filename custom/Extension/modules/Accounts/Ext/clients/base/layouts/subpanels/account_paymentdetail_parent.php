<?php
$viewdefs['Accounts']['base']['layout']['subpanels']['components'][] = array (
    'layout' => 'subpanel',
    'label' => 'LBL_PAYMENTDETAIL_ACCOUNT_TITLE',
    'override_paneltop_view' => 'panel-top-for-j_paymentdetail',
    'context' =>
        array (
            'link' => 'paymentdetail_parent',
        ),
);