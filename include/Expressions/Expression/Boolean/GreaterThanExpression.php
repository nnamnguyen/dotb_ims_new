<?php



/**
 * <b>greaterThan(Number num1, Number num2)</b><br>
 * Returns true num1 is greater than num2.<br/>
 * ex: <i>greaterThan(3, 5)</i> = false
 */
class GreaterThanExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$params = $this->getParameters();

		$a = $params[0]->evaluate();
		$b = $params[1]->evaluate();

		if ( $a > $b )	return AbstractExpression::$TRUE;
		return AbstractExpression::$FALSE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters();
			var a = params[0].evaluate();
			var b = params[1].evaluate();
			if ( a > b )	return DOTB.expressions.Expression.TRUE;
			return DOTB.expressions.Expression.FALSE;
EOQ;
	}

	/**
	 * Any generic type will suffice.
	 */
	static function getParameterTypes() {
		return array("number", "number");
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 2;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "greaterThan";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>