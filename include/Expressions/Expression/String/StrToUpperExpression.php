<?php

/**
 * <b>strToUpper(String s)</b><br/> 
 * Returns <i>s</i> converted to upper case.<br/>
 * ex: <em>strToLower("Hello World")</em> = "HELLO WORLD"
 */
class StrToUpperExpression extends StringExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$param =$this->getParameters();
		if (is_array($param))
			$param = $param[0];
    $strtoupper = function_exists('mb_strtoupper') ? mb_strtoupper($param->evaluate(), 'UTF-8') : strtoupper($param->evaluate());
		return $strtoupper;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var string = this.getParameters().evaluate() + "" ;
			return string.toUpperCase();
EOQ;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "strToUpper";
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
