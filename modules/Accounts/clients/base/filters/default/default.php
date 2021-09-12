<?php

$viewdefs['Accounts']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'status' => array(),
        'international_name' => array(),
        'phone_office' => array(),
        'industry' => array(),
        'website' => array(),
        'phone_fax' => array(),
        'account_type' => array(),
        'tag' => array(),
        'portal_account' => array(),
        'email' => array(),
        'business_code' => array(),
        'employees' => array(),
        'date_of_issue' => array(),
        'annual_revenue' => array(),
        'address_street' => array(
            'dbFields' => array(
                'billing_address_street',
            ),
            'vname' => 'LBL_STREET',
            'type' => 'text',
        ),
        'address_city' => array(
            'dbFields' => array(
                'billing_address_city',
            ),
            'vname' => 'LBL_CITY',
            'type' => 'text',
        ),
        'address_state' => array(
            'dbFields' => array(
                'billing_address_state',
            ),
            'vname' => 'LBL_STATE',
            'type' => 'text',
        ),
        'address_postalcode' => array(
            'dbFields' => array(
                'billing_address_postalcode',
            ),
            'vname' => 'LBL_POSTAL_CODE',
            'type' => 'text',
        ),
        'address_country' => array(
            'dbFields' => array(
                'billing_address_country',
            ),
            'vname' => 'LBL_COUNTRY',
            'type' => 'text',
        ),
        'description' => array(),
        'campaign_name' => array(),
        'assigned_user_name' => array(),
        'team_name' => array(),
        'date_entered' => array(),
        'date_modified' => array(),
        '$owner' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
    ),
);
