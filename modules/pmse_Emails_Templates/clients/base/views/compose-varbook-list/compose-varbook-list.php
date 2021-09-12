<?php



$viewdefs['pmse_Emails_Templates']['base']['view']['compose-varbook-list'] = array(
    'template'   => 'flex-list',
    'selection'  => array(
        'type'                     => 'multi',
        'actions'                  => array(),
        'disable_select_all_alert' => true,
    ),
    'panels'     => array(
        array(
            'fields' => array(
                array(
                    'name'    => 'name',
                    'label'   => 'LBL_LIST_NAME',
                    'enabled' => true,
                    'default' => true,
                ),
                array(
                    'name'     => '_module',
                    'label'    => 'LBL_MODULE',
                    'sortable' => false,
                    'enabled'  => true,
                    'default'  => true,
                ),
            ),
        ),
    ),
);

