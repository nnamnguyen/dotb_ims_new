<?php

$viewdefs['DataPrivacy']['base']['layout']['subpanels'] = array(
    'components' => array(
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_LEADS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'leads',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_CONTACTS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'contacts',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_PROSPECTS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'prospects',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_ACCOUNTS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'accounts',
            ),
        ),
    ),
);
