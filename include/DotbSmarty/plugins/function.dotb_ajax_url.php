<?php




function smarty_function_dotb_ajax_url($params, &$smarty)
{
    if(empty($params['url'])) {
   	    $smarty->trigger_error("ajax_url: missing required param (module)");
        return "";
    }
    return $params['url'];
}

?>
