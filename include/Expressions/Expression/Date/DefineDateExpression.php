<?php


/**
 * <b>date(String d)</b><br>
 * Converts the given string into a date.
 */
class DefineDateExpression extends DateExpression
{
	/**
	 * Get the date from date expression, understands all strftime() formats
	 */
	function evaluate() {
		$params = $this->getParameters()->evaluate();
		return DateExpression::parse($params);
	}


	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters().evaluate();
			var time   = DOTB.util.DateUtils.parse(params, 'user');
			if (time == false)	throw "Incorrect date format";

			return time;
EOQ;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "date";
	}

	/**
	 * All parameters have to be a string.
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
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}

?>