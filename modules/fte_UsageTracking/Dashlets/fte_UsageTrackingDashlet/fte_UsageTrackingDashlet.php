<?php

/*********************************************************************************
 * $Id$
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/fte_UsageTracking/fte_UsageTracking.php');

class fte_UsageTrackingDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/fte_UsageTracking/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'fte_UsageTracking');

        $this->searchFields = $dashletData['fte_UsageTrackingDashlet']['searchFields'];
        $this->columns = $dashletData['fte_UsageTrackingDashlet']['columns'];

        $this->seedBean = new fte_UsageTracking();        
    }
}