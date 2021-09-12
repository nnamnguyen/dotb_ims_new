<?php


/*********************************************************************************
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

$viewdefs['Accounts']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => array(
                array(
                    'name' => 'name',
                    'link' => true,
                    'label' => 'LBL_LIST_ACCOUNT_NAME',
                    'enabled' => true,
                    'default' => true,
                    'width' =>  'xlarge',
                ),
                array(
                    'name' => 'billing_address_city',
                    'label' => 'LBL_LIST_CITY',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'billing_address_country',
                    'label' => 'LBL_BILLING_ADDRESS_COUNTRY',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'phone_office',
                    'label' => 'LBL_LIST_PHONE',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_LIST_ASSIGNED_USER',
                    'id' => 'ASSIGNED_USER_ID',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'email',
                    'label' => 'LBL_EMAIL_ADDRESS',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_modified',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'date_entered',
                    'type' => 'datetime',
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
            ),

        ),
    ),
);
