<?php

$viewdefs['Accounts']['mobile']['layout']['subpanels'] = array(
    'components' => array(
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_CALLS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'calls',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_MEETINGS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'meetings',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_TASKS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'tasks',
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
            'label' => 'LBL_MEMBER_ORG_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'members',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_EMAILS_SUBPANEL_TITLE',
            'linkable' => false,
            'unlinkable' => false,
            'context' => array(
                'link' => 'archived_emails',
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
            'label' => 'LBL_OPPORTUNITIES_SUBPANEL_TITLE',
            'linkable' => false,
            'context' => array(
                'link' => 'opportunities',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_LEADS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'leads',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_CASES_SUBPANEL_TITLE',
            'linkable' => false,
            'context' => array(
                'link' => 'cases',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_RLI_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'revenuelineitems',
            ),
            'linkable' => false,
            'creatable' => false,
            'unlinkable' => false,
        ),
        array (
            'layout' => 'subpanel',
            'label' => 'LBL_PRODUCTS_SUBPANEL_TITLE',
            'context' => array (
                'link' => 'products',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_DOCUMENTS_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'documents',
            ),
        ),
        array(
            'layout' => 'subpanel',
            'label' => 'LBL_QUOTES_SUBPANEL_TITLE',
            'context' => array(
                'link' => 'quotes',
            ),
            'linkable' => false,
        ),
    ),
);
