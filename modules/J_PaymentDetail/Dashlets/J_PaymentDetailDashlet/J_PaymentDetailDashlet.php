<?php

/*********************************************************************************
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/J_PaymentDetail/J_PaymentDetail.php');

class J_PaymentDetailDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/J_PaymentDetail/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'J_PaymentDetail');

        $this->searchFields = $dashletData['J_PaymentDetailDashlet']['searchFields'];
        $this->columns = $dashletData['J_PaymentDetailDashlet']['columns'];

        $this->seedBean = new J_PaymentDetail();        
    }
}