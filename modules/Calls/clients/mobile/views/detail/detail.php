<?php


$viewdefs['Calls']['mobile']['view']['detail'] = array(
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
                array(
                    'name'=>'name',
                    'displayParams'=>array(
                        'required'=>true,
                        'wireless_edit_only'=>true,
                    ),
                ),
                'date_start',
                'direction',
                'status',
                array(
                    'name' => 'duration',
                    'type' => 'fieldset',
                    'orientation' => 'horizontal',
                    'related_fields' => array('duration_hours', 'duration_minutes'),
                    'label' => "LBL_DURATION",
                    'fields' => array(
                        array(
                            'name' => 'duration_hours',
                        ),
                        array(
                            'type' => "label",
                            'default' => "LBL_HOURS_ABBREV",
                            'css_class' => "label_duration_hours hide",
                        ),
                        array(
                            'name' => 'duration_minutes',
                        ),
                        array(
                            'type' => "label",
                            'default' => "LBL_MINSS_ABBREV",
                            'css_class' => "label_duration_minutes hide",

                        ),
                    ),
                ),
                'description',
                'parent_name',
                'assigned_user_name',
                'team_name',
            ),
        ),
	),
);
