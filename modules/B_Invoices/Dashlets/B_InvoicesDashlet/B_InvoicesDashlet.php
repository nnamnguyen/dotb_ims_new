<?php
require_once('modules/B_Invoices/B_Invoices.php');

class B_InvoicesDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/B_Invoices/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'B_Invoices');

        $this->searchFields = $dashletData['B_InvoicesDashlet']['searchFields'];
        $this->columns = $dashletData['B_InvoicesDashlet']['columns'];

        $this->seedBean = new B_Invoices();        
    }
}