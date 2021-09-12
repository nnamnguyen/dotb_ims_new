<?php



$viewdefs['Contacts']['base']['view']['list'] = array(
    'panels' =>
    array(
        0 =>
        array(
            'label' => 'LBL_PANEL_1',
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
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'account_name',
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
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'assigned_user_name',
                    'label' => 'LBL_LIST_ASSIGNED_USER',
                    'id' => 'ASSIGNED_USER_ID',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_modified',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'date_entered',
                    'enabled' => true,
                    'default' => true,
                    'readonly' => true,
                ),
            ),
        ),
    ),
);

