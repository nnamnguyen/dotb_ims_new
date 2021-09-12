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



$subpanel_layout = array(
	'buttons' => array(
            array('widget_class' => 'SubPanelTopCreateButton'),
			array('widget_class' => 'SubPanelTopSelectButton', 'popup_module' => 'Teams'),
	),

	'where' => '',


	'list_fields' => array(
        array(
		    'name' => 'name',
		 	'vname' => 'LBL_NAME',
			'widget_class' => 'SubPanelDetailViewLink',
			'width' => '9999%',
		),
		array(
		    'name' => 'description',
		 	'vname' => 'LBL_DESCRIPTION',
			'width' => '9999%',
		)
	),
);
?>