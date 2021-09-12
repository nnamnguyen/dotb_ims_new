<?php

$viewdefs['EmailTemplates']['base']['filter']['basic'] = array(
    'create' => false,
    'quicksearch_field' => array('name'),
    'quicksearch_priority' => 1,
    'filters' => array(
        array(
            'id'                => 'all_email_type',
            'name'              => 'LBL_FILTER_EMAIL_TYPE_TEMPLATES',
            'filter_definition' => array(
                '$or' => array(
                    array(
                        'type' => array('$is_null' => ''),
                    ),
                    array(
                        'type' => array('$equals' => ''),
                    ),
                    array(
                        'type' => array('$equals' => 'email'),
                    ),
                ),
            ),
            'editable'          => false,
        ),
    ),
);
