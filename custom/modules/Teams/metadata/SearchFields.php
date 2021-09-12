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

$searchFields['Teams'] = 
	array (
		'name' => array('query_type' => 'default', 'db_field' => array('name', 'name_2'), 'force_unifiedsearch' => true),
        'region' => array('query_type' => 'default', 'force_unifiedsearch' => true),
	);
?>
