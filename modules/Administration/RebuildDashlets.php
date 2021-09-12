<?php

global $current_user;
$silent = isset($_REQUEST['silent']) ? true : false;
if(is_admin($current_user)){
    global $mod_strings;
	if (!$silent) { echo $mod_strings['LBL_REBUILD_DASHLETS_DESC']; }
    if(is_file($cachedfile = dotb_cached('dashlets/dashlets.php'))) {
        unlink($cachedfile);
    }

    $dc = new DashletCacheBuilder();
    $dc->buildCache();
   if( !$silent ) echo '<br><br><br><br>' . $mod_strings['LBL_REBUILD_DASHLETS_DESC_SUCCESS'];
}
else{
	dotb_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);
}
?>