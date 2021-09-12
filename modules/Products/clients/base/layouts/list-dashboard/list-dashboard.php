<?php



$viewdefs['Products']['base']['layout']['list-dashboard'] = array(
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
                                                'type' => 'dashablelist',
                                                'label' => 'TPL_DASHLET_MY_MODULE',
                                                'display_columns' =>
                                                    array(
                                                        'name',
                                                        'billing_address_country',
                                                        'billing_address_city',
                                                    ),
                                            ),
                                        'context' =>
                                            array(
                                                'module' => 'Accounts',
                                            ),
                                        'width' => 12,
                                    ),
                                ),
                                array(
                                    array(
                                        'view' =>
                                            array(
                                                'type' => 'dashablelist',
                                                'label' => 'TPL_DASHLET_MY_MODULE',
                                                'display_columns' =>
                                                    array(
                                                        'full_name',
                                                        'account_name',
                                                        'email',
                                                        'phone_work',
                                                    ),
                                            ),
                                        'context' =>
                                            array(
                                                'module' => 'Contacts',
                                            ),
                                        'width' => 12,
                                    ),
                                ),
                            ),
                        'width' => 12,
                    ),
                ),
        ),
    'name' => 'LBL_QUOTED_LINE_ITEMS_LIST_DASHBOARD',
);
