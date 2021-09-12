<?php

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {dotb_getscript} function plugin
 *
 * Type:     function<br>
 * Name:     dotb_getscript<br>
 * Purpose:  Creates script tag for filename with caching string
 *
 * @param array
 * @param Smarty
 */
function smarty_function_dotb_getscript($params, &$smarty)
{
	if(!isset($params['file'])) {
		   $smarty->trigger_error($GLOBALS['app_strings']['ERR_MISSING_REQUIRED_FIELDS'] . 'file');
	}
 	return getVersionedScript($params['file']);
}
?>