<?php


$viewdefs['base']['view']['preview-header'] = array(
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'css_class' => 'btn-link cancel-btn btn-invisible',
            'events' => array(
                'click' => 'button:cancel_button:click',
            ),
        ),
        array(
            'name' => 'save_button',
            'type' => 'button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
            'primary' => true,
            'css_class' => 'save-btn',
            'events' => array(
                'click' => 'button:save_button:click',
            ),
        ),
    ),
);
