<?php

$viewdefs['Quotes']['base']['layout']['subpanels'] = array(
    'type' => 'subpanels',
    'span' => 12,
    'components' => array(
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_QUOTES_J_PAYMENTDETAIL_1_FROM_J_PAYMENTDETAIL_TITLE',
            'override_paneltop_view' => 'panel-top-for-j_paymentdetail',
            'context' =>
                array (
                    'link' => 'quote_paymentdetails',
                ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_QUOTES_B_INVOICES_1_FROM_B_INVOICES_TITLE',
            'context' =>
                array (
                    'link' => 'quotes_b_invoices_1',
                ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_QUOTES_J_PAYMENT_1_FROM_J_PAYMENT_TITLE',
            'override_paneltop_view' => 'panel-top-for-payment',
            'context' =>
                array (
                    'link' => 'quotes_j_payment_1',
                ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_QUOTES_SPONSOR_SUBPANEL_TITLE',
            'override_paneltop_view' => 'panel-top-for-sponsor',
            'context' =>
                array (
                    'link' => 'quotes_sponsor',
                ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_QUOTES_C_SITEDEPLOYMENT_1_FROM_C_SITEDEPLOYMENT_TITLE',
            'override_paneltop_view' => 'panel-top-for-sitedeployment',
            'context' =>
                array (
                    'link' => 'quotes_c_sitedeployment_1',
                ),
        )
//        array(
//            'layout' => 'subpanel',
//            'label' => 'LBL_CALLS_SUBPANEL_TITLE',
//            'context' => array(
//                'link' => 'calls',
//            ),
//        ),
//        array(
//            'layout' => 'subpanel',
//            'label' => 'LBL_MEETINGS_SUBPANEL_TITLE',
//            'context' => array(
//                'link' => 'meetings',
//            ),
//        ),
//        array(
//            'layout' => 'subpanel',
//            'label' => 'LBL_EMAILS_SUBPANEL_TITLE',
//            'context' => array(
//                'link' => 'emails',
//            ),
//        ),
//        array(
//            'layout' => 'subpanel',
//            'label' => 'LBL_TASKS_SUBPANEL_TITLE',
//            'context' => array(
//                'link' => 'tasks',
//            ),
//        ),
//        array(
//            'layout' => 'subpanel',
//            'label' => 'LBL_NOTES_SUBPANEL_TITLE',
//            'context' => array(
//                'link' => 'notes',
//            ),
//        ),
//        array(
//            'layout' => 'subpanel',
//            'label' => 'LBL_DOCUMENTS_SUBPANEL_TITLE',
//            'context' => array(
//                'link' => 'documents',
//            ),
//        ),
//        array(
//            'layout' => 'subpanel',
//            'label' => 'LBL_CONTRACTS_SUBPANEL_TITLE',
//            'context' => array(
//                'link' => 'contracts',
//            ),
//        ),
    ),
);
