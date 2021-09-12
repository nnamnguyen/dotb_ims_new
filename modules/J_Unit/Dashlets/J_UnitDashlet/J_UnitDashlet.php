<?php
require_once('modules/J_Unit/J_Unit.php');

class J_UnitDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/J_Unit/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'J_Unit');

        $this->searchFields = $dashletData['J_UnitDashlet']['searchFields'];
        $this->columns = $dashletData['J_UnitDashlet']['columns'];

        $this->seedBean = new J_Unit();        
    }
}