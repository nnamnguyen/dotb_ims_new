<?php


$viewdefs['Leads']['base']['view']['recordlist'] = array(
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'name' => 'mass_email_button',
                'type' => 'mass-email-button',
                'label' => 'LBL_EMAIL_COMPOSE',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massaction:hide',
                ),
                'acl_module' => 'Emails',
                'acl_action' => 'edit',
                'related_fields' => array('name', 'email'),
            ),

            // Added by Hiếu Pham to compose multi SMS
            array(
                'name' => 'compose_sms',
                'type' => 'button',
                'label' => 'LBL_SEND_SMS',
                'primary' => true,
                'events' => array(
                    'click' => 'list:composeSMS:fire',
                ),
                'acl_action' => 'view',
            ),

            array(
                'name' => 'massupdate_button',
                'type' => 'button',
                'label' => 'LBL_MASS_UPDATE',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massupdate:fire',
                ),
                'acl_action' => 'massupdate',
            ),
            array(
                'name' => 'merge_button',
                'type' => 'button',
                'label' => 'LBL_MERGE',
                'primary' => true,
                'events' => array(
                    'click' => 'list:mergeduplicates:fire',
                ),
                'acl_action' => 'edit',
            ),
            array(
                'name' => 'calc_field_button',
                'type' => 'button',
                'label' => 'LBL_UPDATE_CALC_FIELDS',
                'events' => array(
                    'click' => 'list:updatecalcfields:fire',
                ),
                'acl_action' => 'massupdate',
            ),
            array(
                'name' => 'addtolist_button',
                'type' => 'button',
                'label' => 'LBL_ADD_TO_PROSPECT_LIST_BUTTON_LABEL',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massaddtolist:fire',
                ),
                'acl_module' => 'ProspectLists',
                'acl_action' => 'edit',
            ),
            array(
                'name' => 'massdelete_button',
                'type' => 'button',
                'label' => 'LBL_DELETE',
                'acl_action' => 'delete',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massdelete:fire',
                ),
            ),
            array(
                'name' => 'export_button',
                'type' => 'button',
                'label' => 'LBL_EXPORT',
                'acl_action' => 'export',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massexport:fire',
                ),
            ),

        ),
    ),
    'rowactions' => array(
        'actions' => array(
            array(
                'type' => 'rowaction',

                'tooltip' => 'LBL_PREVIEW',

                'event' => 'list:preview:fire',
                'icon' => 'fa-search-plus',
                'acl_action' => 'view',
            ),

            array(
                'type' => 'rowaction',
                'name' => 'edit_button',


                'tooltip' => 'LBL_EDIT_BUTTON',
                'label' => 'LBL_EDIT_BUTTON',
                'icon' => 'fa-pencil',
                'icon' => 'fa-pencil',
                'label' => 'LBL_EDIT_BUTTON',
                'event' => 'list:editrow:fire',
                'acl_action' => 'edit',
            ),

            array(
                'type' => 'rowaction',
                'name' => 'delete_button',

                'icon' => 'fa-trash-alt',
                'tooltip' => 'LBL_DELETE_BUTTON',
                'label' => 'LBL_DELETE_BUTTON',

                'event' => 'list:deleterow:fire',
                'label' => 'LBL_DELETE_BUTTON',
                'acl_action' => 'delete',
            ),
            array(
                'type' => 'convertbutton',

                'acl_action' => 'edit',
                'icon' => 'fa-level-up',
                'tooltip' => 'LBL_CONVERT_BUTTON',
                'label' => 'LBL_CONVERT_BUTTON'
            ),
        ),
    ),
);
