<?php

$viewdefs["base"]["view"]["dashletselect-headerpane"] = array(
    'template' => 'headerpane',
    'fields' => array(
        array(
            'name' => 'title',
            'type' => 'dotb-dashlet-label',
            'module' => 'Home',
            'label' => 'LBL_DASHLET_ADD',
        ),
    ),
    "buttons" => array(
        array(
            "name"      => "cancel_button",
            "type"      => "button",
            "label"     => "LBL_CANCEL_BUTTON_LABEL",
            "css_class" => "btn-invisible btn-link",
        ),
    ),
);
