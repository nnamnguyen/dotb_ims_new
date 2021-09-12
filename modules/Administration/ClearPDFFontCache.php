<?php


global $current_user;
$silent = isset($_REQUEST['silent']) ? true : false;
if(is_admin($current_user)){
    global $mod_strings;
    if (!$silent) { echo $mod_strings['LBL_CLEAR_PDFFONTS_DESC']; }
    $fontManager = new FontManager();
    if($fontManager->clearCachedFile()){
        if( !$silent ) echo '<br><br><br><br>' . $mod_strings['LBL_CLEAR_PDFFONTS_DESC_SUCCESS'];
    }else{
        if( !$silent ) echo '<br><br><br><br>' . $mod_strings['LBL_CLEAR_PDFFONTS_DESC_FAILURE'];
    }
}
else{
    dotb_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']); 
}
?>
