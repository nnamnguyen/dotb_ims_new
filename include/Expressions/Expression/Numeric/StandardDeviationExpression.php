<?php


/**
 * <b>stddev(Number n, ...)</b><br>
 * Returns the population standard deviation of the <br/>
 * given values.<br>
 * ex: <i>stddev(4, 5, 6, 7, 10)</i> = 2.06
 */
class StandardDeviationExpression extends NumericExpression
{
    /**
     * Returns itself when evaluating.
     */
    public function evaluate()
    {
        $params = $this->getParameters();
        $values = array();

        // find the mean
        $sum = 0;
        $count = sizeof($params);
        foreach ($params as $param) {
            $value = $param->evaluate();
            $values[] = $value;
            $sum = DotbMath::init($sum)->add($value)->result();
        }
        $mean = DotbMath::init($sum)->div($count)->result();

        // find the summation of deviations
        $deviation_sum = 0;
        foreach ($values as $value) {
            $deviation_sum = DotbMath::init($value)->sub($mean)->pow(2)->add($deviation_sum)->result();
        }

        // find the std dev
        return DotbMath::init()->exp('((1/?)*?)', array($count, $deviation_sum))->sqrt()->result();

    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<EOQ
			var params = this.getParameters();
			var values = new Array();

			// find the mean
			var sum   = 0;
			var count = params.length;
			for (var i = 0; i < params.length; i++) {
				value = params[i].evaluate();
				values[values.length] = value;
				sum = this.context.add(sum, value);
			}
			var mean = this.context.divide(sum, count);

			// find the summation of deviations
			var deviation_sum = 0;
			for ( var i = 0; i < values.length; i++ )
				deviation_sum += Math.pow(this.context.subtract(values[i], mean), 2);

			// find the std dev
			var variance = this.context.multiply(this.context.divide(1, count), deviation_sum);

			return Math.sqrt(variance);
EOQ;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return "stddev";
    }

    /**
     * Returns the String representation of this Expression.
     */
    public function toString()
    {
        //pass
    }
}
