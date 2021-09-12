<?php


$viewdefs['Products']['base']['filter']['default'] = array(
    'default_filter' => 'all_records',
    'fields' => array(
        'name' => array(),
        'contact_name' => array(),
        'status' => array(),
        'type_name' => array(),
        'category_name' => array(),
        'manufacturer_name' => array(),
        'mft_part_num' => array(),
        'vendor_part_num' => array(),
        'tax_class'=> array(),
        'support_term'=> array(),
        'date_entered' => array(),
        'date_modified' => array(),
        'tag' => array(),
        '$favorite' => array(
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ),
    ),
);
