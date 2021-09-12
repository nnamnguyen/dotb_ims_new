<?php

$module_name = 'CJ_Forms';
$viewdefs = array (
    $module_name => array (
        'DetailView' => array (
            'templateMeta' => array (
                'form' => array (
                    'buttons' => array ('EDIT', 'DUPLICATE', 'DELETE'),
                    //'footerTpl' => '',
                    //'headerTpl' => '',
                ),
                'maxColumns' => '2',
                'widths' => array (
                    array ('label' => '10', 'field' => '30'),
                    array ('label' => '10', 'field' => '30'),
                ),
                'includes' => array (),
            ),
            'panels' => array (
                'DEFAULT' => array (
                    array ('name'),
                    array ('', 'team_name'),
                    array ('description'),
                    array (
                        array (
                            'name' => 'date_entered',
                            'customCode' => '{$fields.date_entered.value} {$APP.LBL_BY} {$fields.created_by_name.value}',
                            'label' => 'LBL_DATE_ENTERED',
                        ),
                        array (
                            'name' => 'date_modified',
                            'customCode' => '{$fields.date_modified.value} {$APP.LBL_BY} {$fields.modified_by_name.value}',
                            'label' => 'LBL_DATE_MODIFIED',
                        ),
                    ),
                ),
            ),
        ),
    ),
);
