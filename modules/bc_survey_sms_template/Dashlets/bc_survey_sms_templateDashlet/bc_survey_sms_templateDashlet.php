<?php
/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */
/*********************************************************************************
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotbCRM are Copyright (C) DotbCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/bc_survey_sms_template/bc_survey_sms_template.php');

class bc_survey_sms_templateDashlet extends DashletGeneric { 
    public function __construct($id, $def = null)
    {
		global $current_user, $app_strings;
		require('modules/bc_survey_sms_template/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if(empty($def['title'])) $this->title = translate('LBL_HOMEPAGE_TITLE', 'bc_survey_sms_template');

        $this->searchFields = $dashletData['bc_survey_sms_templateDashlet']['searchFields'];
        $this->columns = $dashletData['bc_survey_sms_templateDashlet']['columns'];

        $this->seedBean = new bc_survey_sms_template();        
    }
}