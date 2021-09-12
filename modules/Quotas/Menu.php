<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/

global $mod_strings;

$module_menu = Array(
	Array("index.php?module=Forecasts&action=ListView", $mod_strings['LNK_FORECAST_HISTORY'],"Forecasts"),
	Array("index.php?module=Forecasts&action=index&submodule=Worksheet", $mod_strings['LNK_UPD_FORECAST'],"ForecastWorksheet"),
	Array("index.php?module=Quotas&action=index", $mod_strings['LNK_QUOTA'],"ForecastWorksheet")
);

?>
