<?php

$viewdefs['base']['view']['sweetspot-config-theme'] = array(
    'action' => 'edit',
    'fields' => array(
        array(
            'name' => 'theme',
            'type' => 'enum',
            'label' => 'LBL_SWEETSPOT_THEME_SELECT',
            'enum_width' => 'resolve',
            'options' => 'sweetspot_theme_options',
        ),
    ),
);

