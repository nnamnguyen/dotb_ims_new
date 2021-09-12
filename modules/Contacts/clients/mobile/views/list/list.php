<?php


$viewdefs['Contacts']['mobile']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'default' => true,
                    'enabled' => true,
                    'link' => true,
                    'related_fields' => array('first_name', 'last_name', 'salutation'),
                ),
                array(
                    'name' => 'title',
                    'label' => 'LBL_TITLE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'email',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'phone_work',
                    'label' => 'LBL_OFFICE_PHONE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'phone_mobile',
                    'enabled' => true,
                    'default' => true,
                    'width' => 'large'
                ),
                array(
                    'name' => 'phone_home',
                    'enabled' => true,
                    'default' => true,
                ),
                array (
                    'name' => 'picture',
                    'label' => 'LBL_PICTURE_FILE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'primary_address_street',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'primary_address_city',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'primary_address_state',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'primary_address_postalcode',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'primary_address_country',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'alt_address_street',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'alt_address_city',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'alt_address_state',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'alt_address_postalcode',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'alt_address_country',
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);
