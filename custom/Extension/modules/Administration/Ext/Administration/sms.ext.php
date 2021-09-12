<?php

/**
 * Added by Hieu Pham
 * On 10/03/2019
 * To add send SMS config for admin
 */

$admin_option_defs = array();

$admin_option_defs['Administration']['config_sms_gateway'] = array(
				'icon_AdminMobile',
				'LBL_SMS_GATEWAY_HEADER',
				"LBL_SMS_GATEWAY_DESCRIPTION",
				'./index.php?module=Administration&action=smsConfig'
		); 

/*
    $admin_option_defs['Administration']['config_sms_relationship']= array(
				'icon_AdminMobile',
				'LBL_SMS_RELATIONSHIP_HEADER',
				'LBL_SMS_RELATIONSHIP_DESCRIPTION',
				'./index.php?module=Administration&action=customUsage'
		);
*/

$admin_group_header[]= array(
				'LBL_SMS_CONFIG_HEADER',
				'',
				false,
				$admin_option_defs, 
				'LBL_SMS_CONFIG_DESCRIPTION'
		);
		
