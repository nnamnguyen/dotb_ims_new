<?php

/**
 * <b>isWithinRange(Number num, Number min, Number max)</b><br/>
 * Returns true if <i>num</i> is greater than or equal to <i>min</i> <br/>
 * and less than or equal to <i>max</i>.<br/>
 * ex: <i>isWithinRange(3, 3, 5)</i> = true,<br/>
 * <i>isWithinRange(2, 3, 5)</i> = false,
 *
 */
class IsInRangeExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$params = $this->getParameters();
		$number = $params[0]->evaluate();
		$min    = $params[1]->evaluate();
		$max    = $params[2]->evaluate();

		if ( $number >= $min && $number <= $max )
			return AbstractExpression::$TRUE;

		return AbstractExpression::$FALSE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters();
			var number = params[0].evaluate();
			var min    = params[1].evaluate();
			var max    = params[2].evaluate();

			if ( number >= min && number <= max )
				return DOTB.expressions.Expression.TRUE;

			return DOTB.expressions.Expression.FALSE;
EOQ;
	}

	/**
	 * Any generic type will suffice.
	 */
	static function getParameterTypes() {
		return array("number", "number", "number");
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 3;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "isWithinRange";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>