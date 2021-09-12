<?php



$viewdefs['Prospects']['base']['view']['list'] = array(
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                array(
                    'name' => 'name',
                    'type' => 'fullname',
                    'fields' => array(
                        'salutation',
                        'first_name',
                        'last_name',
                    ),
                    'link' => true,
                    'css_class' => 'full-name',
                    'label' => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'title',
                    'label' => 'LBL_LIST_TITLE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'email',
                    'label' => 'LBL_LIST_EMAIL_ADDRESS',
                    'sortable' => false,
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'phone_work',
                    'label' => 'LBL_LIST_PHONE',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_entered',
                    'label' => 'LBL_DATE_ENTERED',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
            ),
        ),
    ),
);
