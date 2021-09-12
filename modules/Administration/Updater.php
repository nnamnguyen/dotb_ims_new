<?php

/*********************************************************************************
********************************************************************************/




global $app_strings;
global $app_list_strings;
global $mod_strings;
global $current_user;
global $dotb_config;

$xtpl=new XTemplate ('modules/Administration/Updater.html');
$xtpl->assign("MOD", $mod_strings);
$xtpl->assign("APP", $app_strings);

if (isset($_REQUEST['useraction']) && $_REQUEST['useraction']=='Save' ) {
	if(!empty($_REQUEST['type']) && $_REQUEST['type'] == 'automatic') {
		set_CheckUpdates_config_setting('automatic');
	}else{
		set_CheckUpdates_config_setting('manual');
	}

	$beat=false;
	if(!empty($_REQUEST['beat'])) {
		$beat=true;
	}
	if ($beat != get_dotbbeat()) {
		set_dotbbeat($beat);
	}
}

echo getClassicModuleTitle(
        "Administration",
        array(
            "<a href='index.php?module=Administration&action=index'>".translate('LBL_MODULE_NAME','Administration')."</a>",
           $mod_strings['LBL_DOTB_UPDATE_TITLE'],
           ),
        false
        );

if (get_dotbbeat()) $xtpl->assign("SEND_STAT_CHECKED", "checked");

if (get_CheckUpdates_config_setting()=='automatic') {
	$xtpl->assign("AUTOMATIC_CHECKED", "checked");
}

//COMMENT LICENSE - DD
if (isset($_REQUEST['useraction']) && $_REQUEST['useraction']=='CheckNow') {
	//check_now(get_dotbbeat());
	//loadLicense();

}

	/*

$xtpl->parse('main.stats');
	*/


$has_updates= false;
if(!empty($license->settings['license_latest_versions'])){

	$encodedVersions = $license->settings['license_latest_versions'];

	$versions = unserialize(base64_decode( $encodedVersions));
	include('dotb_version.php');
	if(!empty($versions)){
		foreach($versions as $version){
			if(compareVersions($version['version'], $dotb_version))
			{
				$has_updates = true;
				$xtpl->assign("VERSION", $version);
				$xtpl->parse('main.updates.version');
			}
		}
	}
	if(!$has_updates){
		$xtpl->parse('main.noupdates');
	}else{
		$xtpl->parse('main.updates');
	}
}

//return module and index.
$xtpl->assign("RETURN_MODULE", "Administration");
$xtpl->assign("RETURN_ACTION", "index");

$xtpl->parse("main");
$xtpl->out("main");
?>
