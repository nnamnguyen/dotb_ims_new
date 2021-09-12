<?php

/*********************************************************************************
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/J_Voucher/J_Voucher.php');

class J_VoucherDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/J_Voucher/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'J_Voucher');

        $this->searchFields = $dashletData['J_VoucherDashlet']['searchFields'];
        $this->columns = $dashletData['J_VoucherDashlet']['columns'];

        $this->seedBean = new J_Voucher();        
    }
}