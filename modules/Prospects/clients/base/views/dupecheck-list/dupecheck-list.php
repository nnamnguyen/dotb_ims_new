<?php

$viewdefs['Prospects']['base']['view']['dupecheck-list'] = array(
    'panels' => array(
        array(
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
                    'default' => false,
                    'readonly' => true,
                ),
            ),
        ),
    ),
);
