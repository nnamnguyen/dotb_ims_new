<?php



global $dotb_config, $mod_strings;

print( $mod_strings['LBL_CLEAR_ADDITIONAL_CACHE_FINDING'] . "<br>" );


print( $mod_strings['LBL_CLEAR_ADDITIONAL_CACHE_DELETING'] . "<br>" );

$repair = new RepairAndClear();
$repair->show_output = false;
$repair->module_list = array();
$repair->clearAdditionalCaches();

echo "\n--- " . $mod_strings['LBL_DONE'] . "---<br />\n";
?>

