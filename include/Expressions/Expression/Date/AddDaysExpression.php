<?php


/**
 * <b>addDays($date, $days)</b><br>
 * Returns a date object moved forward or backwards by <i>$days</i> days.<br/>
 * ex: <i>addDays(date("1/1/2010"), 5)</i> = "1/6/2010"
 **/
class AddDaysExpression extends DateExpression
{
	/**
	 * Returns the entire enumeration bare.
	 */
	function evaluate() {
        $params = $this->getParameters();

        $date = DateExpression::parse($params[0]->evaluate());
        if(!$date) {
            return false;
        }
        $days = (int) $params[1]->evaluate();
        
        if ($days < 0)
           return $date->modify("$days day");

        return $date->modify("+$days day");
	}


	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
		    var params = this.getParameters();
            var fromDate = params[0].evaluate();
            if (!fromDate) {
                return '';
            }
			var days = parseInt(params[1].evaluate(), 10);
			if (_.isNaN(days)) {
				return '';
			}
			var date = DOTB.util.DateUtils.parse(fromDate, 'user');

            //Clone the object to prevent possible issues with other operations on this variable.
            var d = new Date(date);
            d.setDate(d.getDate() + days);

            // if we're calling this from Lumia, we need to pass back the date
            // as a string, not a Date object otherwise it won't validate properly
            if (this.context.view) {
                d = App.date.format(d, 'Y-m-d');
            }

            return d;
EOQ;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "addDays";
	}
    static function getParameterTypes() {
		return array("date", "number");
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 2;
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
