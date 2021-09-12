<?php

$viewdefs['Notes']['portal']['view']['editmodal'] = array(
    'buttons' => array(
        array(
            'name' => 'cancel_button',
            'type' => 'button',
            'label' => 'LBL_CANCEL_BUTTON_LABEL',
            'value' => 'cancel',
            'css_class' => 'btn-invisible btn-link',
        ), 
        array(
            'name' => 'save_button',
            'type' => 'button',
            'label' => 'LBL_SAVE_BUTTON_LABEL',
            'value' => 'save',
            'css_class' => 'btn-primary',
        ),
    ),
    'panels' => array(
        array(
            'label' => 'LBL_EDIT_BUTTON_LABEL',
            'fields' => array(
                0 =>
                array(
                    'name' => 'name',
                    'default' => true,
                    'enabled' => true,
                    'width' => 35,
                    'required' => true
                ),
                1 =>
                array(
                    'name' => 'description',
                    'default' => true,
                    'enabled' => true,
                    'width' => 35,
                    'required' => true,
                    'rows' => 5,
                ),
                2 =>
                array(
                    'name' => 'filename',
                    'default' => true,
                    'enabled' => true,
                    'sorting' => true,
                    'width' => 35,
                ),
            )
        )
    )
);
