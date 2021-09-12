<?php

$viewdefs['DataPrivacy']['base']['view']['mark-for-erasure-headerpane'] = array(
    'template' => 'headerpane',
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'label',
            'default_value' => 'LBL_DATAPRIVACY_PII',
        ),
    ),
    'buttons' => array(
        array(
            'name' => 'close_button',
            'type' => 'button',
            'label' => 'LBL_CLOSE_BUTTON_TITLE',
            'css_class' => 'btn btn-secondary',
        ),
        array(
            'name' => 'mark_for_erasure_button',
            'type' => 'button',
            'label' => 'LBL_DATAPRIVACY_MARK_FOR_ERASURE',
            'primary' => true,
            'css_class' => 'btn btn-primary disabled',
            'events' => array(
                'click' => 'button:mark_for_erasure_button:click',
            ),
        ),
    ),
);
