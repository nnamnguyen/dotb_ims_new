<?php

/**
 * <b>getDropdownValueSet(String list_name)</b><br>
 * Returns a collection of the translated values in the supplied dropdown list.<br/>
 * This list must be defined in the DropDown editor.<br/>
 * ex: <i>valueAt(2, getDropdownValueSet("my_list"))</i>
 */
class DotbTranslatedDropDownExpression extends EnumExpression
{
	/**
	 * Returns the entire enumeration bare.
	 */
	function evaluate() {
		global $app_list_strings;
		$dd = $this->getParameters()->evaluate();;
		
		if (isset($app_list_strings[$dd]) && is_array($app_list_strings[$dd])) {
			return array_values($app_list_strings[$dd]);
		} 
		
		return array();
	}


	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var dd = this.getParameters().evaluate(),
				arr, ret = [];
			if (App){
				arr = App.lang.getAppListStrings(dd);
			}
			else {
				arr = DOTB.language.get('app_list_strings', dd);
			}
			if (arr && arr != "undefined") {
				for (var i in arr) {
					if (typeof i == "string")
						ret[ret.length] = arr[i];
				}
			}

			return ret;
EOQ;
	}


	/**
	 * Returns the exact number of parameters needed.
	 */
	static function getParamCount() {
		return 1;
	}
	
	/**
	 * All parameters have to be a string.
	 */
    static function getParameterTypes() {
		return AbstractExpression::$STRING_TYPE;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return array("getDropdownValueSet", "getTransDD");
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}

?>