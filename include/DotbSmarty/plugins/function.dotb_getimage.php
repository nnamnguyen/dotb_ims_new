<?php


/**
 * Smarty {dotb_getimage} function plugin
 *
 * Type:     function
 * Name:     dotb_getimage
 * Purpose:  Returns HTML image or sprite
 * 
 * @author Aamir Mansoor (amansoor@dotbcrm.com) 
 * @author Cam McKinnon (cmckinnon@dotbcrm.com)
 * @param array
 * @param Smarty
 */

function smarty_function_dotb_getimage($params, &$smarty) {

	// error checking for required parameters
	if(!isset($params['name'])) 
		$smarty->trigger_error($GLOBALS['app_strings']['ERR_MISSING_REQUIRED_FIELDS'] . 'name');

	// temp hack to deprecate the use of other_attributes
	if(isset($params['other_attributes']))
		$params['attr'] = $params['other_attributes'];

	// set defaults
	if(!isset($params['attr']))
		$params['attr'] = '';
	if(!isset($params['width']))
		$params['width'] = null;
	if(!isset($params['height']))
		$params['height'] = null;
	if(!isset($params['alt'])) 
		$params['alt'] = '';

	// deprecated ?
	if(!isset($params['ext']))
		$params['ext'] = null;

	return DotbThemeRegistry::current()->getImage($params['name'], $params['attr'], $params['width'], $params['height'], $params['ext'], $params['alt']);	
}
?>
