<?php


/**
 * <b>hourOfDay(Date d)</b><br/>
 * Returns the hour of the day (24 hour format) of a given date/time.<br>
 */
class HourOfDayExpression extends TimeExpression
{
	/**
	 * Returns the entire enumeration bare.
	 */
	function evaluate() {
		$params = DateExpression::parse($this->getParameters()->evaluate());
		if(!$params) {
		    return false;
		}
		return $params->hour;
	}


	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var time = this.getParameters().evaluate();
			return new Date(time).getHours();
EOQ;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "hourOfDay";
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