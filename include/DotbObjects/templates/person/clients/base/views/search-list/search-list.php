<?php

$module_name = '<module_name>';
$viewdefs[$module_name]['base']['view']['search-list'] = array(
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
                    'type' => 'fullname',
                    'fields' => array(
                        'salutation',
                        'first_name',
                        'last_name',
                    ),
                    'link' => true,
                ),
            ),
        ),
        array(
            'name' => 'secondary',
            'fields' => array(
                'phone_mobile',
                'email',
                'birthdate',
             ),
        ),
    ),
);
