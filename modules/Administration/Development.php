<?php



global $app_strings;
global $app_list_strings;
global $mod_strings;
global $currentModule;
global $gridline;

echo getClassicModuleTitle('MigrateFields', array($mod_strings['LBL_EXTERNAL_DEV_TITLE']), true);

?>
<p>
<table cellspacing="<?php echo $gridline;?>" class="other view">
<tr>
	<td scope="row"><?php echo DotbThemeRegistry::current()->getImage('ImportCustomFields','align="absmiddle" border="0"',null,null,'.gif',$mod_strings['LBL_IMPORT_CUSTOM_FIELDS_TITLE']); ?>&nbsp;<a href="./index.php?module=Administration&action=ImportCustomFieldStructure" class="tabDetailViewDL2Link"><?php echo $mod_strings['LBL_IMPORT_CUSTOM_FIELDS_TITLE']; ?></a></td>
	<td> <?php echo $mod_strings['LBL_IMPORT_CUSTOM_FIELDS'] ; ?> </td>
</tr>
<tr>
	<td scope="row"><?php echo DotbThemeRegistry::current()->getImage('ExportCustomFields','align="absmiddle" border="0"',null,null,'.gif',$mod_strings['LBL_EXPORT_CUSTOM_FIELDS_TITLE']); ?>&nbsp;<a href="./index.php?module=Administration&action=ExportCustomFieldStructure" class="tabDetailViewDL2Link"><?php echo $mod_strings['LBL_EXPORT_CUSTOM_FIELDS_TITLE']; ?></a></td>
	<td> <?php echo $mod_strings['LBL_EXPORT_CUSTOM_FIELDS'] ; ?> </td>
</tr>

</table></p>


