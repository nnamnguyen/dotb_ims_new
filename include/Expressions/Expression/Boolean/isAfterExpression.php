<?php



/**
 * <b>isAfter(Date day1, Date day2)</b><br>
 * Returns true day1 is after day2.<br/>
 * ex: <i>isBefore(date("1/1/2001"), date("2/2/2002"))</i> = false
 */
class isAfterExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$params = $this->getParameters();

		$a = DateExpression::parse($params[0]->evaluate());
		$b = DateExpression::parse($params[1]->evaluate());

		if(empty($a) || empty($b)) {
		    return false;
		}

		if ( $a > $b )	return AbstractExpression::$TRUE;
		return AbstractExpression::$FALSE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters();
			var a = DOTB.util.DateUtils.parse(params[0].evaluate());
			var b = DOTB.util.DateUtils.parse(params[1].evaluate());

            if (!a || !b || isNaN(a) || isNaN(b)) {
                return DOTB.expressions.Expression.FALSE;
            }

			if ( a > b )	return DOTB.expressions.Expression.TRUE;
			return DOTB.expressions.Expression.FALSE;
EOQ;
	}

	/**
	 * Any generic type will suffice.
	 */
	static function getParameterTypes() {
		return array("date", "date");
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
		return "isAfter";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>
