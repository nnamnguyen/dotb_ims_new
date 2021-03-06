<?php
$module_name = 'J_Loyalty';
$viewdefs[$module_name] =
array (
    'QuickCreate' =>
    array (
        'templateMeta' =>
        array (
            'maxColumns' => '2',
            'widths' =>
            array (
                0 =>
                array (
                    'label' => '10',
                    'field' => '30',
                ),
                1 =>
                array (
                    'label' => '10',
                    'field' => '30',
                ),
            ),
            'useTabs' => false,
            'tabDefs' =>
            array (
                'DEFAULT' =>
                array (
                    'newTab' => false,
                    'panelDefault' => 'expanded',
                ),
            ),
        ),
        'panels' =>
        array (
            'default' =>
            array (
                0 =>
                array (
                    0 =>
                    array (
                        'name' => 'type',
                        'studio' => 'visible',
                        'label' => 'LBL_TYPE',
                        'customCode' => '{html_options name="type" id="type" options=$typeOptions selected=$fields.type.value}'
                    ),
                    1 =>
                    array (
                        'name' => 'student_name',
                        'label' => 'LBL_STUDENT_NAME',
                    ),
                ),
                1 =>
                array (
                    0 =>
                    array (
                        'name' => 'point',
                        'label' => 'LBL_POINT',
                        'customCode'=> '<input tabindex="0" type="text" name="point" id="point" value="{$fields.point.value}" size="4" maxlength="10" style="color: rgb(165, 42, 42);">',
                        'displayParams' =>
                            array (
                                'required' => true,
                                'min' => 1,
                                'max' => 999,
                            ),
                    ),
                    1 =>
                    array (
                        'name' => 'input_date',
                        'label' => 'LBL_INPUT_DATE',
                    ),
                ),
                2 =>
                array (
                    0 =>array (
                        'name' => 'description',
                        'displayParams' =>
                        array (
                            'rows' => 4,
                            'cols' => 60,
                        ),
                    ),
                ),
            ),
        ),
    ),
);
