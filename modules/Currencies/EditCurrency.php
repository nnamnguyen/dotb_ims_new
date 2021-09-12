<?php

 
 /*********************************************************************************

 ********************************************************************************/

global $mod_strings;

if ($current_user->is_admin)
{
    $lc = new ListCurrency();
    $lc->handleDelete();
    $lc->handleAdd();
    $lc->handleUpdate();
    echo $lc->getTable();
}
else
{
    echo $mod_strings['LBL_ADMIN_ONLY'];
}

?>
