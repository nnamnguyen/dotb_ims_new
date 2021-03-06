<?php


/**
 * <b>isValidTime(String time)</b><br/>
 * Returns true if <i>time</i> is in a valid time format. 
 */
class IsValidTimeExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$timeStr = $this->getParameters()->evaluate();

		$time_reg_format = '/^(\d{1,2}):(\d\d)\s*([ap]m)?$/i';
		if ( strlen($timeStr) == 0)	return AbstractExpression::$TRUE;
		//we now support multiple time formats
		$matches = array();
		if ( ! preg_match($time_reg_format, $timeStr, $matches))	return AbstractExpression::$FALSE;
		
		//Check Hours/Min within range
		if ($matches[1] > 23 || $matches[2] > 59)
		{
			return AbstractExpression::$FALSE;
		}
		
		//AM/PM format doesnot support hours > 12 or < 1
		if (!empty($matches[3]) && ($matches[1] > 12 || $matches[1] == 0))
		{
			return AbstractExpression::$FALSE;
		}
		
		return AbstractExpression::$TRUE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
		var timeStr = this.getParameters().evaluate();
		var time_reg_format = /^(\d{1,2}):(\d\d)\s*([ap]m)?$/i;
		if (timeStr.length == 0)	return DOTB.expressions.Expression.TRUE;
		myregexp = new RegExp(time_reg_format)
		if(!myregexp.test(timeStr))	return DOTB.expressions.Expression.FALSE;
		var matches = timeStr.match(time_reg_format);
		if (matches[1] > 23 || matches[2] > 59){return DOTB.expressions.Expression.FALSE;}
		if (matches[3] && (matches[1] > 12 || matches[1] == 0)){return DOTB.expressions.Expression.FALSE;}
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
		return "isValidTime";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>
