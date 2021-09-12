<?php

if (!defined('dotbEntry') || !dotbEntry)
    die('Not A Valid Entry Point');
/**
 * The file used to set definition for dashlet view 
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
require_once('include/Dashlets/DashletGeneric.php');
require_once('modules/bc_survey/bc_survey.php');

class bc_surveyDashlet extends DashletGeneric {

    public function __construct($id, $def = null) {
        global $current_user, $app_strings;
        require('modules/bc_survey/metadata/dashletviewdefs.php');

        parent::__construct($id, $def);

        if (empty($def['title']))
            $this->title = translate('LBL_HOMEPAGE_TITLE', 'bc_survey');

        $this->searchFields = $dashletData['bc_surveyDashlet']['searchFields'];
        $this->columns = $dashletData['bc_surveyDashlet']['columns'];

        $this->seedBean = new bc_survey();
    }

}
