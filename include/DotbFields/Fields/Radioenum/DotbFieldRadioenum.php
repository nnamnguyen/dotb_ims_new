<?php



/**
 * Created: Aug 22, 2011
 */
class DotbFieldRadioenum extends DotbFieldBase {
	/**
	 * Decrypt encrypt fields values before inserting them into the emails
	 * 
	 * @param string $inputField
	 * @param mixed $vardef
	 * @param mixed $displayParams
	 * @param int $tabindex
	 * @return string 
	*/
	public function getEmailTemplateValue($inputField, $vardef, $displayParams = array(), $tabindex = 0){
		global $app_list_strings;
		
		/**
		 * If array doesn't exist for some reason, return key.
		 */
		if (!empty($app_list_strings[$vardef['options']])) {
			if (isset($app_list_strings[$vardef['options']][$inputField])) {
				return $app_list_strings[$vardef['options']][$inputField];
			}
		} 
		return $inputField;
	}
}