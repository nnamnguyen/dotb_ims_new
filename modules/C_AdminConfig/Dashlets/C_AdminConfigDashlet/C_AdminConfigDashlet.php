<?php
require_once('modules/C_AdminConfig/C_AdminConfig.php');

class C_AdminConfigDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/C_AdminConfig/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'C_AdminConfig');

        $this->searchFields = $dashletData['C_AdminConfigDashlet']['searchFields'];
        $this->columns = $dashletData['C_AdminConfigDashlet']['columns'];

        $this->seedBean = new C_AdminConfig();        
    }
}