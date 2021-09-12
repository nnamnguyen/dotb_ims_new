<?php

/*********************************************************************************
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/J_Invoice/J_Invoice.php');

class J_InvoiceDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/J_Invoice/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'J_Invoice');

        $this->searchFields = $dashletData['J_InvoiceDashlet']['searchFields'];
        $this->columns = $dashletData['J_InvoiceDashlet']['columns'];

        $this->seedBean = new J_Invoice();        
    }
}