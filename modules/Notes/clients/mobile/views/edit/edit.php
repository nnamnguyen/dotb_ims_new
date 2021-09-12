<?php


$viewdefs['Notes']['mobile']['view']['edit'] = array(
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
                'description',
                'contact_name',
                'parent_name',
                'filename',
                'assigned_user_name',
                'team_name',
            )
        )
    ),
);
?>
