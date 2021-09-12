<?php

/*********************************************************************************
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/J_Discount/J_Discount.php');

class J_DiscountDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/J_Discount/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'J_Discount');

        $this->searchFields = $dashletData['J_DiscountDashlet']['searchFields'];
        $this->columns = $dashletData['J_DiscountDashlet']['columns'];

        $this->seedBean = new J_Discount();        
    }
}