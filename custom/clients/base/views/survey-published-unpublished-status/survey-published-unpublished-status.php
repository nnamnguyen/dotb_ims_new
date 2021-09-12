<?php
/**
 * The file used to set custom dashlet for Survey Send Status Report
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
$viewdefs['base']['view']['survey-published-unpublished-status'] = array(
    'dashlets' => array(
        array(
            'label' => 'Survey Send Status Report',
            'description' => 'Survey Send Status report based on submission',
            'config' => array(),
            'preview' => array(),
           
            
        ),
    ),
    'custom_toolbar' => array(
        'buttons' => array(
            array(
                "type" => "dashletaction",
                "css_class" => "btn btn-invisible dashlet-toggle minify",
                "icon" => "fa-chevron-up",
                "action" => "toggleMinify",
                "tooltip" => "LBL_DASHLET_TOGGLE",
            ),
            array(
                'dropdown_buttons' => array(
                    array(
                        'type' => 'dashletaction',
                        'action' => 'editClicked',
                        'label' => 'LBL_DASHLET_CONFIG_EDIT_LABEL',
                    ),
                    array(
                        'type' => 'dashletaction',
                        'action' => 'refreshClicked',
                        'label' => 'LBL_DASHLET_REFRESH_LABEL',
                    ),
                    array(
                        'type' => 'dashletaction',
                        'action' => 'removeClicked',
                        'label' => 'LBL_DASHLET_REMOVE_LABEL',
                    ),
                ),
            ),
        ),
    ),
);
