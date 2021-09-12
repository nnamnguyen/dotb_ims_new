<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/

global $mod_strings, $app_strings;
$module_menu = Array();
if(is_admin_for_module($GLOBALS['current_user'],'Products'))$module_menu[]= Array("index.php?module=Shippers&action=EditView&return_module=Shippers&return_action=DetailView", $mod_strings['LNK_NEW_SHIPPER'],"Shippers");
                                                            $module_menu[]= Array("index.php?module=TaxRates&action=EditView&return_module=TaxRates&return_action=DetailView", $mod_strings['LNK_NEW_TAXRATE'],"TaxRates");if(ACLController::checkAccess('TaxRates', 'import', true))  $module_menu[] =Array("index.php?module=Import&action=Step1&import_module=TaxRates&return_module=TaxRates&return_action=index", $mod_strings['LNK_IMPORT_TAXRATES'],"Import", 'Contacts');

?>