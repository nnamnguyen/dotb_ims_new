<?php


/**
 * <b>add(Number n, ...)</b><br>
 * Returns the sum of the given numbers.<br/>
 * ex: <i>add(2, 1, 3)</i> = 6
 */
class AddExpression extends NumericExpression
{
    /**
     * The Logic for running in PHP, this uses DotbMath as to avoid potential floating-point errors
     *
     * @returns String
     */
    public function evaluate()
    {
        $sum = '0';
        foreach ($this->getParameters() as $expr) {
            $sum = DotbMath::init($sum, 6)->add($expr->evaluate())->result();
        }

        return (string)$sum;
    }

    /**
     * Returns the JS Equivalent of the evaluate function, When in lumia it uses DotbMath, but when outside of
     * lumia it uses a custom method to convert the values to a float and then back into a fixed `string` with a
     * precision of 6
     */
    public static function getJSEvaluate()
    {
        return <<<JS
			var params = this.getParameters(),
			    sum = 0;
			for (var i = 0; i < params.length; i++) {
                sum = this.context.add(sum, params[i].evaluate());
            }
			return sum;
JS;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return array('add', 'currencyAdd');
    }

    /**
     * Returns the String representation of this Expression.
     */
    public function toString()
    {
        $str = "";

        foreach ($this->getParameters() as $expr) {
            if (!$expr instanceof ConstantExpression) {
                $str .= "(";
            }
            $str .= $expr->toString();
            if (!$expr instanceof ConstantExpression) {
                $str .= ")";
            }
        }
    }
}
