<?php


$viewdefs['Leads']['mobile']['view']['edit'] = array(
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
                array(
                    'name' => 'first_name',
                    'customCode' => '{html_options name="salutation" options=$fields.salutation.options selected=$fields.salutation.value}&nbsp;<input name="first_name" size="25" maxlength="25" type="text" value="{$fields.first_name.value}">',
                    'displayParams' => array('wireless_edit_only' => true,),
                ),
                array('name' => 'last_name',
                    'displayParams' => array('wireless_edit_only' => true,),
                ),
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
                'status',
                'assigned_user_name',

                'team_name',
            )
        ),
    )
);
?>
