<?php


function smarty_function_dotb_teamset_badges($params, &$smarty)
{
    if (!isset($params['items'])) {
        $smarty->trigger_error("dotb_teamset_badges: missing 'items' parameter");
        return;
    }

    $badges = array();
    if (!empty($params['items']['primary'])) {
        $badges[] = $GLOBALS['app_strings']['LBL_COLLECTION_PRIMARY'];
    }
    if (!empty($params['items']['selected'])) {
        $badges[] = $GLOBALS['app_strings']['LBL_TEAM_SET_SELECTED'];
    }

    return implode(', ', $badges);
}
