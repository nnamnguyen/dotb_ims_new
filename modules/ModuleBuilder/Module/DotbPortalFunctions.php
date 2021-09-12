<?php



class DotbPortalFunctions{

	function getNodes()
	{
	    global $mod_strings;
		$nodes = array();
        $nodes[] = array( 'name'=>$mod_strings['LBL_PORTAL_CONFIGURE'], 'action'=>'module=ModuleBuilder&action=portalconfig','imageTitle' => 'SPSync', );
        $nodes[] = array( 'name'=>$mod_strings['LBL_PORTAL_THEME'], 'action'=>'javascript: window.parent.App.router.navigate("Styleguide/layout/themeroller",{trigger: true});','imageTitle' => 'SPUploadCSS', );
		return $nodes;
	}
	
	
	
	
	
	
}
?>