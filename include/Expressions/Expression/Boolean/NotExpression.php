<?php


/**
 * <b>not(Boolean b)</b><br/>
 * Returns false if <i>b</i> is true, and true if <i>b</i> is false.<br/>
 * ex: <i>not(false)</i> = true
 */
class NotExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		if ( $this->getParameters()->evaluate() === AbstractExpression::$FALSE)
			return AbstractExpression::$TRUE;
		else
			return AbstractExpression::$FALSE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			if ( this.getParameters().evaluate() == DOTB.expressions.Expression.FALSE )
				return DOTB.expressions.Expression.TRUE;
			else
				return DOTB.expressions.Expression.FALSE;
EOQ;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "not";
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 1;
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>