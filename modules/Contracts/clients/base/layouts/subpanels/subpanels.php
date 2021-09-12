<?php


$viewdefs['Contracts']['base']['layout']['subpanels'] = array(
    'components' => array(
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_DOCUMENTS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'contracts_documents',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_NOTES_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'notes',
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
            'label' => 'LBL_QUOTES_SUBPANEL_TITLE',
            'override_paneltop_view' => 'panel-top-for-contracts',
            'override_subpanel_list_view' => 'subpanel-for-contracts',
            'context' => array(
                'link' => 'quotes',
                'ignore_role' => 0,
            ),
        ),
    ),
);
