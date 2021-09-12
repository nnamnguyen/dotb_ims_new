<?php

/*********************************************************************************
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/J_Payment/J_Payment.php');

class J_PaymentDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/J_Payment/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'J_Payment');

        $this->searchFields = $dashletData['J_PaymentDashlet']['searchFields'];
        $this->columns = $dashletData['J_PaymentDashlet']['columns'];

        $this->seedBean = new J_Payment();        
    }
}