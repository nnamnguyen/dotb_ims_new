<?php
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

/*
 * bug 59290 - this file was reverted, comment left so upgrader picks up the modified file - rbacon
 */
  $searchdefs['Teams'] = array(
					'templateMeta' => array(
							'maxColumns' => '3', 
                            'maxColumnsBasic' => '4', 
                            'widths' => array('label' => '10', 'field' => '30'),                 
                           ),
                    'layout' => array(  					
						'basic_search' => array(
						    'name' => array('name' => 'name', 'label' => 'LBL_NAME',),
                            'region' => array('name' => 'region', 'label' => 'LBL_REGION', 'type' => 'enum',),
						 	),
						'advanced_search' => array(),
					),
 			   );
?>
