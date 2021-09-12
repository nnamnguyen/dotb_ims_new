<?php

/*********************************************************************************

 * Description:
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc. All Rights
 * Reserved. Contributor(s): ______________________________________..
 * *******************************************************************************/

session_start();
$GLOBALS['installing'] = true;

require_once('include/JSON.php');
require_once('include/utils/db_utils.php');
require_once('include/utils/zip_utils.php');
require_once('modules/UpgradeWizard/uw_utils.php');

$json = getJSONobj();

 $_SESSION['totalUpgradeTime'] = $_SESSION['totalUpgradeTime']+$_REQUEST['upgradeStepTime'];
 $response = $_SESSION['totalUpgradeTime'];

$GLOBALS['log']->fatal('TOTAL TIME .....'.$_SESSION['totalUpgradeTime']);
 $GLOBALS['log']->fatal($response);

 if (!empty($response)) {
    $json = getJSONobj();
	print $json->encode($response);
 }

dotb_cleanup();
exit();
