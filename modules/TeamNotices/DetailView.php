<?php

/*********************************************************************************

 ********************************************************************************/
if (!$GLOBALS['current_user']->isAdminForModule('Users')) dotb_die($GLOBALS['app_strings']['ERR_NOT_ADMIN']);

include ("modules/TeamNotices/index.php");
?>