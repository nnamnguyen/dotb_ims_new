<?php







global $mod_strings;
global $app_list_strings;
global $app_strings;
global $current_language;
global $dotb_config;
global $dotb_flavor;
global $dotb_version;

$send_version = isset($dotb_version) ? $dotb_version : "";
$send_edition = isset($dotb_flavor) ? $dotb_flavor : "";
$send_lang = isset($current_language) ? $current_language : "";
$send_key = isset($dotb_config['unique_key']) ? $dotb_config['unique_key'] : "";


$dotb_smarty = new Dotb_Smarty();

$iframe_url = add_http("www.dotbcrm.com/network/redirect.php?to=training&tmpl=network&version={$send_version}&edition={$send_edition}&language={$send_lang}&key={$send_key}");
$dotb_smarty->assign('iframeURL', $iframe_url);

echo $dotb_smarty->fetch('modules/Home/TrainingPortal.tpl');

?>
