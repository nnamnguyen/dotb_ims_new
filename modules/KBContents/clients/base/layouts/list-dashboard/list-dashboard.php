<?php



$viewdefs['KBContents']['base']['layout']['list-dashboard'] = array(
    'metadata' =>
        array(
            'components' =>
                array(
                    array(
                        'rows' =>
                            array(
                                array(
                                    array(
                                        'view' =>
                                            array(
                                                'type' => 'dashlet-nestedset-list',
                                                'label' => 'LBL_DASHLET_CATEGORIES_NAME',
                                                'data_provider' => 'Categories',
                                                'config_provider' => 'KBContents',
                                                'root_name' => 'category_root',
                                                'extra_provider' => array(
                                                    'module' => 'KBContents',
                                                    'field' => 'category_id',
                                                ),
                                            ),
                                        'context' =>
                                            array(
                                                'module' => 'KBContents',
                                            ),
                                        'width' => 12,
                                    ),
                                ),
                                array(
                                    array(
                                        'view' => array(
                                            'type' => 'kbs-dashlet-most-useful',
                                            'label' => 'LBL_DASHLET_MOST_USEFUL_NAME',
                                        ),
                                        'context' => array(
                                            'module' => 'KBContents',
                                        ),
                                        'width' => 12,
                                    ),
                                ),
                            ),
                        'width' => 12,
                    ),
                ),
        ),
    'name' => 'LBL_KBCONTENTS_LIST_DASHBOARD',
);
