<?php

/*********************************************************************************
 * Description:
 * Portions created by DotBCRM are Copyright (C) DotBCRM, Inc. All Rights
 * Reserved. Contributor(s): ______________________________________..
 * *******************************************************************************/


/**
 * This script pulls all columns of type VARCHAR2 and of byte-length semantic  to dynamically update them to character-
 * length semantics.
 */

global $dotb_config;
$db = DBManagerFactory::getInstance();

$userName = strtoupper($dotb_config['dbconfig']['db_user_name']);
$q = "SELECT TABLE_NAME, COLUMN_NAME, CHAR_LENGTH FROM ALL_TAB_COLS WHERE TABLE_NAME IN (SELECT TABLE_NAME FROM USER_TABLES) AND DATA_TYPE = 'VARCHAR2' AND CHAR_USED = 'B' AND OWNER = '{$userName}' ORDER BY TABLE_NAME";
$r = $db->query($q);

$display = '';
while($a = $db->fetchByAssoc($r)) {
	if(isset($_REQUEST['commit']) && $_REQUEST['commit'] == 'true' && !isset($_SESSION['REPAIR_ORACLE_VARCHAR_COLS'])) {
		$db->query("ALTER TABLE {$a['table_name']} MODIFY {$a['column_name']} VARCHAR2({$a['char_length']} CHAR)");
	} else {
		if(!empty($display))
			$display .= "\n";
		$display .= "ALTER TABLE {$a['table_name']} MODIFY {$a['column_name']} VARCHAR2({$a['char_length']} CHAR);";
	}
}

///////////////////////////////////////////////////////////////////////////////
////	OUTPUT
if(isset($_REQUEST['commit']) && $_REQUEST['commit'] == 'true') {
	$_SESSION['REPAIR_ORACLE_VARCHAR_COLS'] = true;
	echo "<br /><div>{$mod_strings['LBL_REPAIR_ORACLE_COMMIT_DONE']}</div>";	
}

if(!empty($display)) {
	$out =<<<eoq
	<div>
		{$mod_strings['LBL_REPAIR_ORACLE_VARCHAR_DESC_LONG_1']}
	</div>
	<br \>
	<div>
		<textarea cols='100' rows='10'>{$display}</textarea>
	</div>
	<div>
		<form name='form' action='index.php' method='POST'>
			<input type='hidden' name='module' value='Administration'>
			<input type='hidden' name='action' value='RepairOracleVarcharColumns'>
			<input type='hidden' name='commit' value='true'>
			<input type='submit' class='button' name='submit' value="   {$mod_strings['LBL_REPAIR_ORACLE_COMMIT']}   ">
		</form>
	</div>
eoq;
	echo $out;
} else {
	echo $mod_strings['LBL_REPAIR_ORACLE_VARCHAR_DESC_LONG_2'];
}
?>