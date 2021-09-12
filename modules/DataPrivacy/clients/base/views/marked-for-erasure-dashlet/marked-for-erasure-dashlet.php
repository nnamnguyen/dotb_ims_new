<?php

$viewdefs['DataPrivacy']['base']['view']['marked-for-erasure-dashlet'] = array (
    'dashlets' => array (
        array (
            'label' => 'LBL_MARKED_FOR_ERASURE_TITLE',
            'description' => 'LBL_MARKED_FOR_ERASURE_DASHLET_DESCRIPTION',
            'filter' => array (
                'module' => array (
                    'DataPrivacy',
                ),
                'view' => 'record',
            ),
            //Empty config that is ignored as this dashlet is not configurable.
            //Only here to allow the dashlet to be selected
            'config' => array (
                'enabled' => true,
            ),
        ),
    ),
    'custom_toolbar' => array (
        'buttons' => array (
            array (
                'dropdown_buttons' => array (
                    array(
                        "type" => "dashletaction",
                        "action" => "editClicked",
                        "label" => "LBL_DASHLET_CONFIG_EDIT_LABEL",
                    ),
                    array (
                        'type' => 'dashletaction',
                        'action' => 'removeClicked',
                        'label' => 'LBL_DASHLET_REMOVE_LABEL',
                    ),
                ),
            ),
        ),
    ),
);
