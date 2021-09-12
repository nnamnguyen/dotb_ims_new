<?php


$viewdefs['KBContents']['base']['view']['related-documents'] = array(
    'dashlets' => array(
        array(
            'label' => 'LBL_DASHLET_RELATED_DOCUMENTS',
            'description' => 'LBL_DASHLET_RELATED_DOCUMENTS_DESC',
            'config' => array(
                'limit' => 5,
            ),
            'preview' => array(
                'limit' => 5,
            ),
            'filter' => array(
                'module' => array(
                    //TODO: Must be uncommented when RS-838 is done
                    //'KBContents',
                ),
                'view' => 'record',
            ),
        ),
    ),
    'panels' => array(
        array(
            'name' => 'panel_body',
            'columns' => 2,
            'labelsOnTop' => true,
            'placeholders' => true,
            'fields' => array(
                array(
                    'name' => 'limit',
                    'label' => 'LBL_DASHLET_CONFIGURE_DISPLAY_ROWS',
                    'type' => 'enum',
                    'options' => 'dashlet_limit_options',
                ),
            ),
        ),
    ),
);
