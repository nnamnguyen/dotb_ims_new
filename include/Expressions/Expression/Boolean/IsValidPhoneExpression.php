<?php


/**
 * <b>isValidPhone(String phone)</b><br/>
 * Returns true if <i>phone</i> is in a valid phone format. 
 */
class IsValidPhoneExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$phoneStr = $this->getParameters()->evaluate();

		if( strlen($phoneStr) == 0) return AbstractExpression::$TRUE;
		if(! preg_match('/^\+?[0-9\-\(\)\s]+$/', $phoneStr) )
			return AbstractExpression::$FALSE;
		return AbstractExpression::$TRUE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
		var phoneStr = this.getParameters().evaluate();
		if(phoneStr.length== 0) 	return DOTB.expressions.Expression.TRUE;
		if( ! /^\+?[0-9\-\(\)\s]+$/.test(phoneStr) )
			return DOTB.expressions.Expression.FALSE;
		return DOTB.expressions.Expression.TRUE;
EOQ;
	}

	/**
	 * Any generic type will suffice.
	 */
	static function getParameterTypes() {
		return array("string");
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 1;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "isValidPhone";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>
