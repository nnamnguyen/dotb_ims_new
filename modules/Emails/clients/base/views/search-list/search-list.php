<?php

$viewdefs['Emails']['base']['view']['search-list'] = array(
    'panels' => array(
        array(
            'name' => 'primary',
            'fields' => array(
                array(
                    'name' => 'picture',
                    'type' => 'avatar',
                    'size' => 'medium',
                    'readonly' => true,
                    'css_class' => 'pull-left',
                ),
                array(
                    'name' => 'name',
                    'type' => 'name',
                    'link' => true,
                    'label' => 'LBL_SUBJECT',
                ),
            ),
        ),
        array(
            'name' => 'secondary',
            'fields' => array(
                array(
                    'name' => 'from_addr_name',
                    'label' => 'LBL_FROM',
                ),
                array(
                    'name' => 'date_sent',
                    'label' => 'LBL_DATE',
                ),
            ),
        ),
    ),
);
