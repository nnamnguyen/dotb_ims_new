<?php


/**
 * <b>isAlpha(String string)</b><br>
 * Returns true if "string" contains only letters.
 *
 */
class IsAlphaExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$params = $this->getParameters()->evaluate();
		if ( preg_match('/^[a-zA-Z]+$/', $params) )	return AbstractExpression::$TRUE;
		return AbstractExpression::$FALSE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters().evaluate();
			if ( /^[a-zA-Z]+$/.test(params) )	return DOTB.expressions.Expression.TRUE;
			return DOTB.expressions.Expression.FALSE;
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
		return "isAlpha";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>