<?php

/*********************************************************************************

 * Description:  Saves an Account record and then redirects the browser to the 
 * defined return URL.
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
$formBase = new CallFormBase();
if ($formBase->prepareRecurring()) {
    if ($limit = $formBase->checkRecurringLimitExceeded()) {
        echo str_replace('$limit', $limit, $GLOBALS['mod_strings']['LBL_RECURRING_LIMIT_ERROR']);
        dotb_cleanup(true);
    }
}
$formBase->handleSave('', true, false);
?>
