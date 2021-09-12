<?php


/**
 * false
 * returns the boolean value of false.
 */
class FalseExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		return AbstractExpression::$FALSE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return "\t\t\treturn DOTB.expressions.Expression.FALSE;";
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "false";
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 0;
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
		return "false";
	}
}
