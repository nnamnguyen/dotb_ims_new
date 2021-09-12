<?php
require_once('modules/C_SMS/C_SMS.php');

class C_SMSDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/C_SMS/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'C_SMS');

        $this->searchFields = $dashletData['C_SMSDashlet']['searchFields'];
        $this->columns = $dashletData['C_SMSDashlet']['columns'];

        $this->seedBean = new C_SMS();        
    }
}