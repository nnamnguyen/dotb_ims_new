<?php
require_once('modules/C_CRMLicense/C_CRMLicense.php');

class C_CRMLicenseDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/C_CRMLicense/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'C_CRMLicense');

        $this->searchFields = $dashletData['C_CRMLicenseDashlet']['searchFields'];
        $this->columns = $dashletData['C_CRMLicenseDashlet']['columns'];

        $this->seedBean = new C_CRMLicense();        
    }
}