<?php



$viewdefs['Leads']['mobile']['view']['detail'] = array(
    'templateMeta' => array(
        'maxColumns' => '1',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
        ),
    ),
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                'full_name',
                'title',
                'account_name',
                'phone_work',
                'phone_mobile',
                'phone_home',
                'email',
                'primary_address_street',
                'primary_address_city',
                'primary_address_state',
                'primary_address_postalcode',
                'primary_address_country',
                'alt_address_street',
                'alt_address_city',
                'alt_address_state',
                'alt_address_postalcode',
                'alt_address_country',
                'status',
                'assigned_user_name',

                'team_name',
            )
        ),
    )
);
?>
