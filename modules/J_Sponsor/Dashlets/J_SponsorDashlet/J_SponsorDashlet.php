<?php

/*********************************************************************************
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/J_Sponsor/J_Sponsor.php');

class J_SponsorDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/J_Sponsor/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'J_Sponsor');

        $this->searchFields = $dashletData['J_SponsorDashlet']['searchFields'];
        $this->columns = $dashletData['J_SponsorDashlet']['columns'];

        $this->seedBean = new J_Sponsor();        
    }
}