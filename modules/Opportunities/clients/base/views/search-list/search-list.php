<?php

$viewdefs['Opportunities']['base']['view']['search-list'] = array(
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
                    'name' => 'date_closed',
                    'type' => 'date',
                    'label' => 'LBL_DATE_CLOSED'
                )
            ),
        ),
    ),
);

