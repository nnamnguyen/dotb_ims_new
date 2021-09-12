<?php

/**
 * <b>strToLower(String s)</b><br/>
 * Returns <i>s</i> converted to lower case.<br/>
 * ex: <em>strToLower("Hello World")</em> = "hello world"
 */
class StrToLowerExpression extends StringExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$param =$this->getParameters();
		if (is_array($param))
			$param = $param[0];
    $strtolower = function_exists('mb_strtolower') ? mb_strtolower($param->evaluate(), 'UTF-8') : strtolower($param->evaluate());
		return $strtolower;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var string = this.getParameters().evaluate() + "";
			return string.toLowerCase();
EOQ;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "strToLower";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}

    /**
     * Return param count to prevent errors.
     */
    public static function getParamCount()
    {
        return 1;
    }
}
?>
