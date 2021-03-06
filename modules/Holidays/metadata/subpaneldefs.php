<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * By installing or using this file, you are confirming on behalf of the entity
 * subscribed to the DotbCRM Inc. product ("Company") that Company is bound by
 * the DotbCRM Inc. Master Subscription Agreement (“MSA”), which is viewable at:
 * http://www.dotbcrm.com/master-subscription-agreement
 *
 * If Company is not bound by the MSA, then by installing or using this file
 * you are agreeing unconditionally that Company will be bound by the MSA and
 * certifying that you have authority to bind Company accordingly.
 *
 * Copyright (C) 2004-2013 DotbCRM Inc.  All rights reserved.
 ********************************************************************************/

 


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
/*			'top_buttons' => array(
				array('widget_class' => 'SubPanelTopButtonQuickCreate', 'view' => 'UsersQuickCreate',),
			),*/
			'title_key' => 'LBL_USER_HOLIDAY_SUBPANEL_TITLE',
		),
	),
);
?>