<?php




$viewdefs['pmse_Emails_Templates']['base']['view']['compose-dotblinks-list'] = array(
    'template' => 'flex-list',
    'selection' => array(
        'type' => 'single',
        'actions' => array(),
        'label' => 'LBL_LINK_SELECT',
    ),
    'panels' => array(
        array(
            'fields' => array(
                array(
                    'name' => 'text',
                    'label' => 'LBL_MODULE',
                    'sortable' => false,
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name' => 'relatedTo',
                    'label' => 'LBL_RELATIONSHIP',
                    'sortable' => false,
                    'enabled' => true,
                    'default' => true,
                ),
            ),
        ),
    ),
);

