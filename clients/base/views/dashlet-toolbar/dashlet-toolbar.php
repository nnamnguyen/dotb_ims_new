<?php

$viewdefs["base"]["view"]["dashlet-toolbar"] = array(
    "buttons" => array(
        array(
            "type" => "dashletaction",
            "css_class" => "btn btn-invisible dashlet-toggle minify",
            "icon" => "fa-chevron-up",
            "action" => "toggleMinify",
            "tooltip" => "LBL_DASHLET_TOGGLE",
        ),
        array(
            "dropdown_buttons" => array(
                array(
                    "type" => "dashletaction",
                    "action" => "editClicked",
                    "label" => "LBL_DASHLET_CONFIG_EDIT_LABEL",
                    "name" => "edit_button",
                ),
                array(
                    "type" => "dashletaction",
                    "action" => "refreshClicked",
                    "label" => "LBL_DASHLET_REFRESH_LABEL",
                    "name" => "refresh_button",
                ),
                array(
                    "type" => "dashletaction",
                    "action" => "removeClicked",
                    "label" => "LBL_DASHLET_REMOVE_LABEL",
                    "name" => "remove_button",
                ),
            )
        )
    )
);
