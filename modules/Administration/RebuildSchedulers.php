<?php

require_once 'include/DotbSmarty/plugins/function.dotb_csrf_form_token.php';

echo getClassicModuleTitle('Administration', array($mod_strings['LBL_REBUILD_SCHEDULERS_TITLE']), false);

if(isset($_REQUEST['perform_rebuild']) && $_REQUEST['perform_rebuild'] == 'true') {
	
	require_once('install/install_utils.php');
	$focus = BeanFactory::newBean('Schedulers');
	$focus->rebuildDefaultSchedulers();
	
$admin_mod_strings = return_module_language($current_language, 'Administration');	
?>
<table cellspacing="{CELLSPACING}" class="otherview">
	<tr> 
		<td scope="row" width="35%"><?php echo $admin_mod_strings['LBL_REBUILD_SCHEDULERS_DESC_SUCCESS']; ?></td>
		<td><a href="index.php?module=Administration&action=Upgrade"><?php echo $admin_mod_strings['LBL_RETURN']; ?></a></td>
	</tr>
</table>
<?php
} else {
?>	
<p>
<form name="RebuildSchedulers" method="post" action="index.php">
<?php echo smarty_function_dotb_csrf_form_token(array(), $smarty); ?>
<input type="hidden" name="module" value="Administration">
<input type="hidden" name="action" value="RebuildSchedulers">
<input type="hidden" name="return_module" value="Administration">
<input type="hidden" name="return_action" value="Upgrade">
<input type="hidden" name="perform_rebuild" value="true">
<table cellspacing="{CELLSPACING}" class="other view">
	<tr>
	    <td scope="row" width="15%"><?php echo $mod_strings['LBL_REBUILD_SCHEDULERS_TITLE']; ?></td>
	    <td><input type="submit" name="button" value="<?php echo $mod_strings['LBL_REBUILD']; ?>"></td>
	</tr>
	<tr> 
		<td colspan="2" scope="row"><?php echo $mod_strings['LBL_REBUILD_SCHEDULERS_DESC']; ?></td>
	</tr>
</table>
</form>
</p>
<?php
}
?>