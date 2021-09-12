<?php
require_once('modules/J_GroupUnit/J_GroupUnit.php');

class J_GroupUnitDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/J_GroupUnit/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'J_GroupUnit');

        $this->searchFields = $dashletData['J_GroupUnitDashlet']['searchFields'];
        $this->columns = $dashletData['J_GroupUnitDashlet']['columns'];

        $this->seedBean = new J_GroupUnit();        
    }
}