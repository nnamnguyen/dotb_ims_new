<?php
require_once('modules/C_ParentAppLicense/C_ParentAppLicense.php');

class C_ParentAppLicenseDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/C_ParentAppLicense/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'C_ParentAppLicense');

        $this->searchFields = $dashletData['C_ParentAppLicenseDashlet']['searchFields'];
        $this->columns = $dashletData['C_ParentAppLicenseDashlet']['columns'];

        $this->seedBean = new C_ParentAppLicense();        
    }
}