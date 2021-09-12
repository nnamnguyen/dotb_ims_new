<?php


/**
 * Smarty {dotb_getlink} function plugin
 *
 * Type:     function
 * Name:     dotb_getlink
 * Purpose:  Returns HTML link <a> with embedded image or normal text
 * 
 * @param array
 * @param Smarty
 */

function smarty_function_dotb_getlink($params, &$smarty) {

	// error checking for required parameters
	if(!isset($params['url'])) 
		$smarty->trigger_error($GLOBALS['app_strings']['ERR_MISSING_REQUIRED_FIELDS'] . 'url');
	if(!isset($params['title']))
		$smarty->trigger_error($GLOBALS['app_strings']['ERR_MISSING_REQUIRED_FIELDS'] . 'title');

	// set defaults
	if(!isset($params['attr']))
		$params['attr'] = '';
	if(!isset($params['img_name'])) 
		$params['img_name'] = '';
	if(!isset($params['img_attr']))
		$params['img_attr'] = '';
	if(!isset($params['img_width']))
		$params['img_width'] = null;
	if(!isset($params['img_height']))
		$params['height'] = null;
	if(!isset($params['img_placement']))
		$params['img_placement'] = 'imageonly';
	if(!isset($params['img_alt']))
		$params['img_alt'] = '';

	return DotbThemeRegistry::current()->getLink($params['url'], $params['title'], $params['attr'], $params['img_name'], 
		$params['img_attr'], $params['img_width'], $params['img_height'], $params['img_alt'], $params['img_placement']);	
}
?>
