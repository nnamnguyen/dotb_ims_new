<?php



$viewdefs['KBContents']['base']['view']['module-menu'] = array(
    'config' => array(
        'data_provider' => 'Categories',
        'config_provider' => 'KBContents',
        'root_name' => 'category_root'
    ),
    'label' => 'LNK_LIST_KBCATEGORIES',
    'filterDef' => array(
        array(
            'active_rev' => array(
                '$equals' => '1',
            ),
        ),
    ),
);
