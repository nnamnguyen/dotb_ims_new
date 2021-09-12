<?php


use Dotbcrm\Dotbcrm\Security\InputValidation\InputValidation;

$module_name = InputValidation::getService()->getValidInputRequest('module_name', 'Assert\Mvc\ModuleName', '');

if(isset($_REQUEST['refreshparent'])){
	echo '<SCRIPT> parent.location.reload();</script>';	
} elseif (!empty($module_name) && isset($_REQUEST['showlist'])) {
    $the_strings = return_module_language($current_language, $module_name);
	echo DotbThemeRegistry::current()->getCSS();
	echo '<table width="100%" border="0" cellspacing=0 cellpadding="0" class="contentBox">';
	$dotb_body_only = 0;
	if(isset($_REQUEST['dotb_body_only'])){
		$dotb_body_only = $_REQUEST['dotb_body_only'];
	}
	foreach($the_strings as $key=>$value){
        echo "<tr><td nowrap>$key &nbsp;=>&nbsp; <a href='index.php?action=EditView&module=LabelEditor&
            module_name=$module_name&record=$key&dotb_body_only=$dotb_body_only&style=popup'> $value </a></td></tr>";
	}
	echo '</table>';
} elseif (!empty($module_name)) {
    $the_strings = return_module_language($current_language, $module_name);
	global $app_strings;
	echo '<form name="ListEdit"  name="EditView" method="POST" action="index.php">';
	echo '<input type="hidden" name="action" value="Save">';
	echo '<input type="hidden" name="multi_edit" value="true">';
    echo '<input type="hidden" name="module_name" value="'.$module_name.'">';
	echo '<input type="hidden" name="module" value="LabelEditor">';
	echo DotbThemeRegistry::current()->getCSS();
	echo <<<EOQ
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
	<td><input title="{$app_strings['LBL_SAVE_BUTTON_TITLE']}" accessKey="{$app_strings['LBL_SAVE_BUTTON_KEY']}" class="button" type="submit" name="button" value="  {$app_strings['LBL_SAVE_BUTTON_LABEL']}  " > &nbsp;<input title="{$app_strings['LBL_CANCEL_BUTTON_TITLE']}" accessKey="{APP.LBL_CANCEL_BUTTON_KEY}" class="button" type="button" name="button" onclick="document.location.reload()" value="  {$app_strings['LBL_CANCEL_BUTTON_LABEL']}  " ></td>
	</tr>
	</table>
	
EOQ;
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="edit view">';
	$dotb_body_only = 0;
	if(isset($_REQUEST['dotb_body_only'])){
		$dotb_body_only = $_REQUEST['dotb_body_only'];
	}
	foreach($the_strings as $key=>$value){
		echo "<tr><td><span class='dataLabel'>$value</span><br><span style='font-size: 9;'>$key</span><br><input name='$key' value='$value' size='40'></td></tr>";	
		
	}
	echo '</table>';
	echo <<<EOQ
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
	<td style="padding-top: 2px;"><input title="{$app_strings['LBL_SAVE_BUTTON_TITLE']}"  class="button" type="submit" name="button" value="  {$app_strings['LBL_SAVE_BUTTON_LABEL']}  " > &nbsp;<input title="{$app_strings['LBL_CANCEL_BUTTON_TITLE']}" class="button" type="button" name="button" onclick="document.location.reload()" value="  {$app_strings['LBL_CANCEL_BUTTON_LABEL']}  " ></td>
	</tr>
	</table>
	
EOQ;
	echo '</form>';
}else{
	echo 'No Module Selected';
}	


?>