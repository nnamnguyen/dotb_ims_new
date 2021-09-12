<?php


$viewdefs['ContractTypes']['base']['view']['recordlist'] = array(
    'selection' => array(
        'type' => 'multi',
        'actions' => array(
            array(
                'name' => 'merge_button',
                'type' => 'button',
                'label' => 'LBL_MERGE',
                'primary' => true,
                'events' => array(
                    'click' => 'list:mergeduplicates:fire',
                ),
                'acl_action' => 'edit',
            ),
            array(
                'name' => 'delete_button',
                'type' => 'button',
                'label' => 'LBL_DELETE',
                'acl_action' => 'delete',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massdelete:fire',
                ),
            ),
            array(
                'name' => 'export_button',
                'type' => 'button',
                'label' => 'LBL_EXPORT',
                'acl_action' => 'export',
                'primary' => true,
                'events' => array(
                    'click' => 'list:massexport:fire',
                ),
            ),
        ),
    ),
);
