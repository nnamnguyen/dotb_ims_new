<?php

/*********************************************************************************

 * Description:  TODO To be written.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

global $mod_strings, $dotb_config, $app_strings;

if(ACLController::checkAccess('Quotes', 'edit', true))$module_menu[] =Array("index.php?module=Quotes&action=EditView&return_module=Quotes&return_action=DetailView", $mod_strings['LNK_NEW_QUOTE'],"CreateQuotes");
if(ACLController::checkAccess('Quotes', 'list', true))$module_menu[] =Array("index.php?module=Quotes&action=index&return_module=Quotes&return_action=index", $mod_strings['LNK_QUOTE_LIST'],"Quotes");
if (ACLController::checkAccess('Quotes', 'list', true)) {
    $module_menu[] = array(
        'index.php?module=Reports&action=index&view=quotes',
        $mod_strings['LNK_QUOTE_REPORTS'],
        'QuoteReports',
        'Quotes',
    );
}
