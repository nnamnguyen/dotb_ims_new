<?php


/**
 * <b>dayofweek(Date d)</b><br>
 * Returns the day of week that <i>d</i> falls on.<br/>
 * Sun = 0, Mon = 1, ... , Sat = 6
 */
class DayOfWeekExpression extends NumericExpression
{
	/**
	 * Returns day of week for the date.
	 */
	function evaluate() {
		$params = DateExpression::parse($this->getParameters()->evaluate());
        if(!$params) {
            return false;
        }
		return $params->day_of_week;
	}


    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<EOQ
            var day,
                time = this.getParameters().evaluate();

            if (_.isString(time) && _.isEmpty(time)) {
                return '';
            }
            //Checks to see if the user is on a lumia view and return results as a string
            if (this.context.view) {
                day = App.date(time).format('d').toString();
            } else {
                day = new Date(time).getDay();
            }

           return day;
EOQ;
    }

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "dayofweek";
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 1;
	}

    /**
	 * All parameters have to be a date.
	 */
    static function getParameterTypes() {
		return array(AbstractExpression::$DATE_TYPE);
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
