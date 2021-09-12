<?php
/**
 * The file used to set custom dashlet for Survey Repsonse Report
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
$viewdefs['base']['view']['surveyresponse'] = array(
    'dashlets' => array(
        array(
            'label' => 'Survey Response Report',
            'description' => 'Survey Response report based on submission',
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
    'dashlet_config_panels' => array(
        array(
            'name' => 'panel_body',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'saved_report',
                    'label' => 'Select a survey',
                    'type' => 'relate',
                    'id_name' => 'saved_report_id',
                    'module' => 'bc_survey',
                    'rname' => 'name',
                ),
            ),
        ),
    ),
);
