<?php




$edit_mod_strings = return_module_language($GLOBALS['current_language'], 'EditCustomFields');
$edit_mod_strings['LBL_DROP_DOWN_LIST'] = $edit_mod_strings['LBL_RADIO_FIELDS'];
require_once('modules/DynamicFields/templates/Fields/Forms/enum2.php');
?>
