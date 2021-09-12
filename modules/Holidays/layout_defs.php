<?php

 

$layout_defs['UserHolidays'] = array(
	'subpanel_setup' => array(
		'holidays' => array(
			'order' => 30,
			'sort_by' => 'holiday_date',
			'sort_order' => 'asc',
			'module' => 'Holidays',
			'subpanel_name' => 'default',
			'get_subpanel_data' => 'holidays',
			'add_subpanel_data' => 'holiday_id',
			'top_buttons' => array(
				array('widget_class' => 'SubPanelTopButtonQuickCreate'),
			),
			'title_key' => 'LBL_USER_HOLIDAY_SUBPANEL_TITLE',
		),
	),
);
?>