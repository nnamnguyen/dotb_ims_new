<?php



/**
 * <b>isValidDate(String date)</b><br/>
 * Returns true if <i>date</i> is a valid date string.
 *
 */
class IsValidDateExpression extends BooleanExpression {
	/**
	 * Returns true if a passed in date string (in User format) is valid
	 */
	function evaluate() {
        global $current_user;
        $dtStr = $this->getParameters()->evaluate();

        if(empty($dtStr)) {
            return AbstractExpression::$FALSE;
        }
        try {
            $td = TimeDate::getInstance();
            $date = $td->fromUser($dtStr, $current_user);
            if(!empty($date) && $td->asUser($date) == $dtStr) {
                return AbstractExpression::$TRUE;
            }
            //Next try without time
            $date = $td->fromUserDate($dtStr, $current_user);
            if(!empty($date) && $td->asUserDate($date) == $dtStr)  {
                return AbstractExpression::$TRUE;
            }
            return AbstractExpression::$FALSE;
        } catch(Exception $e) {
            return AbstractExpression::$FALSE;
        }
	}

	/**
	 * Returns true is a passed in date string (in user format) is valid.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
		var dtStr = this.getParameters().evaluate();
        if (typeof dtStr != "string" || dtStr == "") return DOTB.expressions.Expression.FALSE;
        var format = "Y-m-d";
        if (DOTB.expressions.userPrefs)
            format = DOTB.expressions.userPrefs.datef;
        var date = DOTB.util.DateUtils.parse(dtStr, format);
        if(date != false && date != "Invalid Date")
		    return DOTB.expressions.Expression.TRUE;
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
		return "isValidDate";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>
