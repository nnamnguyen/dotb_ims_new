<?php



$viewdefs['base']['view']['user-wizard-page'] = array(
    'title' => 'LBL_WIZ_USER_PROFILE_TITLE',
    'message' => 'LBL_SETUP_USER_INFO',
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'first_name',
                    'label' => "LBL_WIZ_FIRST_NAME",
                ),
                array(
                    'name' => 'last_name',
                    'label' => "LBL_WIZ_LAST_NAME",
                    'required' => true,
                ),
                array(
                    'name' => 'email',
                    'type' => 'email-text',
                    'label' => "LBL_WIZ_EMAIL",
                    'required' => true,
                    // disable this field only for user wizard view
                    // because email field is complex and has personal save/update server behavior
                    'idm_mode_disabled' => true,
                ),
                array(
                    'name' => 'phone_work',
                    'type' => 'phone',
                    'label' => 'LBL_LIST_PHONE',
                ),
            ),
        ),
    ),
);
