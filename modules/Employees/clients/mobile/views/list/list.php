<?php



$viewdefs['Employees']['mobile']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'name',
                    'label' => 'LBL_NAME',
                    'link' => true,
                    'orderBy' => 'last_name',
                    'default' => true,
                    'enabled' => true,
                    'related_fields' => array('first_name', 'last_name', 'salutation'),
                ),
                array(
                    'name' => 'title',
                    'label' => 'LBL_TITLE',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'email',
                    'label' => 'LBL_EMAIL',
                    'sortable' => false,
                    'link' => true,
                    'customCode' => '{$EMAIL_LINK}{$EMAIL}</a>',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'phone_work',
                    'label' => 'LBL_OFFICE_PHONE',
                    'default' => true,
                    'enabled' => true,
                ),
                array(
                    'name' => 'phone_home',
                    'label' => 'LBL_HOME_PHONE',
                    'default' => false,
                ),
                array(
                    'name' => 'phone_mobile',
                    'label' => 'LBL_MOBILE_PHONE',
                    'default' => false,
                    'width' => 'large'
                ),
                array(
                    'name' => 'phone_other',
                    'label' => 'LBL_WORK_PHONE',
                    'default' => false,
                ),
                array(
                    'name' => 'phone_fax',
                    'label' => 'LBL_FAX_PHONE',
                    'default' => false,
                ),
                array(
                    'name' => 'address_street',
                    'label' => 'LBL_PRIMARY_ADDRESS_STREET',
                    'default' => false,
                ),
                array(
                    'name' => 'address_city',
                    'label' => 'LBL_PRIMARY_ADDRESS_CITY',
                    'default' => false,
                ),
                array(
                    'name' => 'address_state',
                    'label' => 'LBL_PRIMARY_ADDRESS_STATE',
                    'default' => false,
                ),
                array(
                    'name' => 'address_postalcode',
                    'label' => 'LBL_PRIMARY_ADDRESS_POSTALCODE',
                    'default' => false,
                ),
                array(
                    'name' => 'date_entered',
                    'label' => 'LBL_DATE_ENTERED',
                    'default' => false,
                    'readonly' => true,
                ),
                array (
                    'name' => 'picture',
                    'label' => 'LBL_PICTURE_FILE',
                    'enabled' => true,
                    'default' => true,
                ),

                array(
                    'name' => 'team_name',
                    'label' => 'LBL_TEAM',
                    'default' => true,
                    'enabled' => true,
                ),
            ))));
?>
