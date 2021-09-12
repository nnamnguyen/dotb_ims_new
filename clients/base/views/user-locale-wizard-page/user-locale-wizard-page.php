<?php



$viewdefs['base']['view']['user-locale-wizard-page'] = array(
    'title' => 'LBL_WIZ_USER_LOCALE_TITLE',
    'message' => 'LBL_SETUP_USER_LOCALE_INFO',
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'timezone',
                    'type' => 'enum',
                    'label' => "LBL_WIZ_TIMEZONE",
                    'required' => true,
                ),
                array(
                    'name' => 'timepref',
                    'type' => 'enum',
                    'label' => "LBL_WIZ_TIMEFORMAT",
                    'required' => true,
                ),
                array(
                    'name' => 'datepref',
                    'type' => 'enum',
                    'label' => "LBL_WIZ_DATE_FORMAT",
                    'required' => true,
                ),
                array(
                    'name' => 'default_locale_name_format',
                    'type' => 'enum',
                    'label' => 'LBL_WIZ_NAME_FORMAT',
                    'required' => true,
                    //Define something other than comma since that is used in name format values
                    'separator' => '|',
                ),
            ),
        ),
    ),
);
