<?php



    $viewdefs['Notifications']['base']['view']['list'] = array(
        'favorites' => false,
        'panels' => array(
            array(
                'label' => 'LBL_PANEL_1',
                'fields' => array(
                    array(
                        'name' => 'severity',
                        'type' => 'severity',
                        'default' => true,
                        'enabled' => true,
                        'css_class' => 'full-width',
                        'width' => 'small',
                    ),
                    array(
                        'name' => 'name',
                        'default' => true,
                        'enabled' => true,
                        'link' => true,
                    ),
                    array(
                        'name' => 'parent_name',
                        'label' => 'LBL_LIST_RELATED_TO',
                        'id' => 'PARENT_ID',
                        'link' => true,
                        'default' => true,
                        'enabled' => true,
                        'sortable' => false,
                    ),
                    array(
                        'name' => 'description',
                        'label' => 'LBL_DESCRIPTION',
                        'default' => true,
                        'enabled' => true,
                        'sortable' => false,
                        'width' => 'xlarge',
                    ),
                    array (
                        'name' => 'assigned_user_name',
                        'sortable' => false,
                        'enabled' => true,
                        'default' => false,
                    ),
                    array(
                        'name' => 'date_entered',
                        'default' => false,
                        'enabled' => true,
                    ),
                    array(
                        'name' => 'date_modified',
                        'default' => false,
                        'enabled' => true,
                    ),
                    array(
                        'name' => 'is_read',
                        'type' => 'read',
                        'default' => true,
                        'enabled' => true,
                        'css_class' => 'full-width',
                        'width' => 'small',
                    ),
                ),
            ),
        ),
        'orderBy' => array(
            'field' => 'date_entered',
            'direction' => 'desc',
        ),
    );
