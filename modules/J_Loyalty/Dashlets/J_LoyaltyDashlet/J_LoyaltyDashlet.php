<?php

/*********************************************************************************
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/J_Loyalty/J_Loyalty.php');

class J_LoyaltyDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/J_Loyalty/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'J_Loyalty');

        $this->searchFields = $dashletData['J_LoyaltyDashlet']['searchFields'];
        $this->columns = $dashletData['J_LoyaltyDashlet']['columns'];

        $this->seedBean = new J_Loyalty();        
    }
}