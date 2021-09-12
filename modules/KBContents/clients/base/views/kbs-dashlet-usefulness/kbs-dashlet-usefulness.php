<?php


$viewdefs['KBContents']['base']['view']['kbs-dashlet-usefulness'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_DASHLET_USEFULNESS_NAME',
            'description' => 'LBL_DASHLET_USEFULNESS_DESC',
            'config' => array(
                'module' => 'KBContents'
            ),
            'preview' => array(),
            'filter' => array(
                'module' => array(
                    'KBContents',
                ),
                'view' => 'record',
            ),
        ),
    ),
    'chart' => array(
        'name' => 'chart',
        'label' => 'Chart',
        'type' => 'chart',
        'view' => 'detail'
    ),
);
