<?php
$module_name = 'fte_UsageTracking';
$viewdefs[$module_name] =
    array(
        'base' =>
            array(
                'view' =>
                    array(
                        'record' =>
                            array(
                                'buttons' =>
                                    array(
                                        0 =>
                                            array(
                                                'name' => 'sidebar_toggle',
                                                'type' => 'sidebartoggle',
                                            ),
                                    ),
                                'panels' =>
                                    array(
                                        0 =>
                                            array(
                                                'name' => 'panel_header',
                                                'label' => 'LBL_RECORD_HEADER',
                                                'header' => true,
                                                'fields' =>
                                                    array(
                                                        0 =>
                                                            array(
                                                                'name' => 'picture',
                                                                'type' => 'avatar',
                                                                'width' => 42,
                                                                'height' => 42,
                                                                'dismiss_label' => true,
                                                                'readonly' => true,
                                                            ),
                                                        1 => 'name',
                                                        2 =>
                                                            array(
                                                                'name' => 'favorite',
                                                                'label' => 'LBL_FAVORITE',
                                                                'type' => 'favorite',
                                                                'readonly' => true,
                                                                'dismiss_label' => true,
                                                            ),
                                                        3 =>
                                                            array(
                                                                'name' => 'follow',
                                                                'label' => 'LBL_FOLLOW',
                                                                'type' => 'follow',
                                                                'readonly' => true,
                                                                'dismiss_label' => true,
                                                            ),
                                                    ),
                                            ),
                                        1 =>
                                            array(
                                                'name' => 'panel_body',
                                                'label' => 'LBL_RECORD_BODY',
                                                'columns' => 2,
                                                'labelsOnTop' => true,
                                                'placeholders' => true,
                                                'newTab' => false,
                                                'panelDefault' => 'expanded',
                                                'fields' =>
                                                    array(
                                                        0 =>
                                                            array(
                                                                'name' => 'action_identifier',
                                                            ),
                                                        1 =>
                                                            array(
                                                                'name' => 'platform',
                                                            ),
                                                        2 =>
                                                            array(
                                                                'name' => 'action',
                                                                'label' => 'LBL_FTE_UT_ACTION',
                                                            ),
                                                        3 =>
                                                            array(
                                                                'name' => 'related_record',
                                                                'type' => 'fte_related_fieldset',
                                                                'label' => 'LBL_RELATED_TO',
                                                                'fields' => array(
                                                                    array (
                                                                        'name' => 'parent_name',
                                                                        'label' => 'LBL_RELATED_TO',
                                                                        'enabled' => true,
                                                                        'id' => 'PARENT_ID',
                                                                        'link' => true,
                                                                        'sortable' => false,
                                                                        'default' => true,
                                                                    ),
                                                                    array(
                                                                        'name' => 'related_module_name',
                                                                    ),
                                                                ),
                                                            ),
                                                    ),
                                            ),
                                        2 =>
                                            array(
                                                'name' => 'panel_hidden',
                                                'label' => 'LBL_SHOW_MORE',
                                                'hide' => true,
                                                'columns' => 2,
                                                'labelsOnTop' => true,
                                                'placeholders' => true,
                                                'newTab' => false,
                                                'panelDefault' => 'expanded',
                                                'fields' =>
                                                    array(
                                                        0 =>
                                                            array(
                                                                'name' => 'description',
                                                                'span' => 12,
                                                            ),
                                                        1 =>
                                                            array(
                                                                'name' => 'date_modified_by',
                                                                'readonly' => true,
                                                                'inline' => true,
                                                                'type' => 'fieldset',
                                                                'label' => 'LBL_DATE_MODIFIED',
                                                                'fields' =>
                                                                    array(
                                                                        0 =>
                                                                            array(
                                                                                'name' => 'date_modified',
                                                                            ),
                                                                        1 =>
                                                                            array(
                                                                                'type' => 'label',
                                                                                'default_value' => 'LBL_BY',
                                                                            ),
                                                                        2 =>
                                                                            array(
                                                                                'name' => 'modified_by_name',
                                                                            ),
                                                                    ),
                                                            ),
                                                        2 =>
                                                            array(
                                                                'name' => 'date_entered_by',
                                                                'readonly' => true,
                                                                'inline' => true,
                                                                'type' => 'fieldset',
                                                                'label' => 'LBL_DATE_ENTERED',
                                                                'fields' =>
                                                                    array(
                                                                        0 =>
                                                                            array(
                                                                                'name' => 'date_entered',
                                                                            ),
                                                                        1 =>
                                                                            array(
                                                                                'type' => 'label',
                                                                                'default_value' => 'LBL_BY',
                                                                            ),
                                                                        2 =>
                                                                            array(
                                                                                'name' => 'created_by_name',
                                                                            ),
                                                                    ),
                                                            ),
                                                    ),
                                            ),
                                    ),
                                'templateMeta' =>
                                    array(
                                        'useTabs' => false,
                                    ),
                            ),
                    ),
            ),
    );
