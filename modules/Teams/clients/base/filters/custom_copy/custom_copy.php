<?php
$viewdefs['Teams']['base']['filter']['custom_copy']['filters'][] = array(
    'id' => 'custom_copy',
    'name' => 'Custom',
    'filter_definition' => array(
        array(
            'private' => array(
                '$equals' => 0,
            )
        )
    ),
    'editable' => true,
    'is_template' => false
);