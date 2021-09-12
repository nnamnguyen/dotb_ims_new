<?php

/*********************************************************************************

 * Description:
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc. All Rights
 * Reserved. Contributor(s): ______________________________________..
 * *******************************************************************************/

if(ob_get_level() < 1)
	ob_start();
ob_implicit_flush(1);

// load the generated persistence file if found
$persistence = array();
if(file_exists($persist = dotb_cached('/modules/UpgradeWizard/_persistence.php'))) {
	require_once $persist;
}
require_once('modules/UpgradeWizard/uw_utils.php');
require_once('include/utils/zip_utils.php');

switch($_REQUEST['preflightStep']) {
	case 'find_upgrade_files':
		logThis('preflightJson finding upgrade files');
		ob_end_flush();
		$persistence['upgrade_files'] = preflightCheckJsonFindUpgradeFiles();
	break;

	case 'diff_upgrade_files':
		logThis('preflightJson diffing upgrade files');
		ob_end_flush();
		$persistence = preflightCheckJsonDiffFiles();
	break;

	case 'get_diff_results':
		logThis('preflightJson getting diff results for display');
		ob_end_flush();
		$persistence = preflightCheckJsonGetDiff();
	break;

	case 'get_diff_errors':
		logThis('preflightJson getting diff errors (if any)');
		preflightCheckJsonGetDiffErrors();
	break;
}

write_array_to_file('persistence', $persistence, $persist);
