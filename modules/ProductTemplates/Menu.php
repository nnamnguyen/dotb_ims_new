<?php

/*********************************************************************************

 * Description:  
 ********************************************************************************/

global $mod_strings;
$module_menu = Array(
	Array("index.php?module=ProductTemplates&action=EditView&return_module=ProductTemplates&return_action=DetailView", $mod_strings['LNK_NEW_PRODUCT'],"Products"),
	Array("index.php?module=ProductTemplates&action=index&return_module=ProductTemplates&return_action=DetailView", $mod_strings['LNK_PRODUCT_LIST'],"Price_List"),
	Array("index.php?module=Manufacturers&action=EditView&return_module=Manufacturers&return_action=DetailView", $mod_strings['LNK_NEW_MANUFACTURER'],"Manufacturers"),
	Array("index.php?module=ProductCategories&action=EditView&return_module=ProductCategories&return_action=DetailView", $mod_strings['LNK_NEW_PRODUCT_CATEGORY'],"Product_Categories"),
	Array("index.php?module=ProductTypes&action=EditView&return_module=ProductTypes&return_action=DetailView", $mod_strings['LNK_NEW_PRODUCT_TYPE'],"Product_Types"),
	Array("index.php?module=Import&action=Step1&import_module=ProductTemplates&return_module=ProductTemplates&return_action=index", $mod_strings['LNK_IMPORT_PRODUCTS'],"Import"),

	);

?>
