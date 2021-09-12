<?php



/**
 * <b>hoursUntil(Date d)</b><br>
 * Returns number of hours from now until the specified date.
 */
class HoursUntilExpression extends NumericExpression
{
    /**
     * Returns number of hours from now until the specified date.
     */
    public function evaluate()
    {
        $params = DateExpression::parse($this->getParameters()->evaluate());
        if (!$params) {
            return false;
        }

        $now = TimeDate::getInstance()->getNow(true);
        $tsdiff = $params->ts - $now->ts;

        return (int) ($tsdiff / 3600);
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<EOQ
            var value = this.getParameters().evaluate();
            var then = DOTB.util.DateUtils.parse(value);

            if (!then && then !== 0) return false;
            var now = new Date();

            // If we have a date field
            if (typeof value == 'string' && value.indexOf(' ') == -1 && value.indexOf('T') == -1) {
                now.setHours(0, 0, 0, 0);
            }

            var diff = then - now;

            return ~~(diff / 3600000);
EOQ;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return 'hoursUntil';
    }

    /**
     * All parameters have to be a date.
     */
    public static function getParameterTypes()
    {
        return array(AbstractExpression::$DATE_TYPE);
    }

    /**
     * Returns the maximum number of parameters needed.
     */
    public static function getParamCount()
    {
        return 1;
    }

    /**
     * Returns the String representation of this Expression.
     */
    public function toString()
    {
    }
}
