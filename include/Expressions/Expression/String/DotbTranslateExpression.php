<?php


/**
 * <b>translateLabel(String label, String module)</b><br/>
 * Returns the translated version of a given label key<br/>
 * ex: <i>translateLabel("LBL_NAME", "Accounts")</i> = "Name"
 */
class DotbTranslateExpression extends StringExpression {
	
	function evaluate() {
		$params = $this->getParameters();
        $module = $params[1]->evaluate();
        if ($module == "")
              $module = "app_strings";
        $key = $params[0]->evaluate();
        return translate($key, $module);
	}
	
	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
		  var params = this.getParameters();
		  var module = params[1].evaluate();
		  if (module == "")
		      module = "app_strings";
		  var key = params[0].evaluate();
		  return DOTB.language.get(module, key);
EOQ;
	}
	
	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return array("translateLabel", "translate");
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 2;
	}
}
?>