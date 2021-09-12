<?php



$viewdefs['Reports']['mobile']['view']['detail'] = array(
    'templateMeta' => array(
        'maxColumns' => '1',
        'widths' => array(
            array('label' => '10', 'field' => '30'),
        ),
    ),
    'panels' => array(
        array(
            'label' => 'LBL_PANEL_DEFAULT',
            'fields' => array(
                'name',
                array(
                    'name' => 'module',
                    'readonly' => true,
                    'type' => 'enum',
                    'options' => 'moduleList',
                ),
                array(
                    'name' => 'report_type',
                    'readonly' => true,
                    'type' => 'enum',
                    'options' => 'dom_report_types',
                ),
                'assigned_user_name',
                'team_name',
            )
        )
    ),
);
?>