<?php
if(!defined('dotbEntry') || !dotbEntry) die('Not A Valid Entry Point');
/*
 * Your installation or use of this DotbCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotbCRM file.
 *
 * Copyright (C) DotbCRM Inc. All rights reserved.
 */
/*********************************************************************************
 * $Id$
 * Description:  Defines the English language pack for the base application.
 * Portions created by DotbCRM are Copyright (C) DotbCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
 
global $app_strings;

$dashletMeta['bc_survey_languageDashlet'] = array('module'		=> 'bc_survey_language',
										  'title'       => translate('LBL_HOMEPAGE_TITLE', 'bc_survey_language'), 
                                          'description' => 'A customizable view into bc_survey_language',
                                          'icon'        => 'icon_bc_survey_language_32.gif',
                                          'category'    => 'Module Views');