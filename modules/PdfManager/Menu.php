<?php



global $mod_strings, $dotb_config, $app_strings;

if(DotbACL::checkAccess('PdfManager', 'edit', true))$module_menu[] =Array("index.php?module=PdfManager&action=EditView&return_module=PdfManager&return_action=DetailView", $mod_strings['LNK_NEW_RECORD'],"CreatePdfManager");
if(DotbACL::checkAccess('PdfManager', 'list', true))$module_menu[] =Array("index.php?module=PdfManager&action=index&return_module=PdfManager&return_action=index", $mod_strings['LNK_LIST'],"PdfManager");

$module_menu[] =Array("index.php?return_module=PdfManager&return_action=index&module=Configurator&action=DotbpdfSettings", $mod_strings['LNK_EDIT_PDF_TEMPLATE'], "PdfManager");
