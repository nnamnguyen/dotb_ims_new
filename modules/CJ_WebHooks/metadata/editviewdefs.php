<?php

$module_name = 'CJ_WebHooks';
$viewdefs = array (
    $module_name => array (
        'EditView' => array (
            'templateMeta' => array (
                'form' => array (
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
                ),
            ),
        ),
    ),
);
