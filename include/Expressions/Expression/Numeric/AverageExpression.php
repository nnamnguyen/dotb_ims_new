<?php


/**
 * <b>average(Number n, ...)</b><br>
 * Returns the average of the given numbers<br/>
 * ex: <i>average(2, 5, 11)</i> = 6
 */
class AverageExpression extends NumericExpression
{
    /**
     * Returns itself when evaluating.
     */
    public function evaluate()
    {
        $sum = 0;
        $count = 0;
        foreach ($this->getParameters() as $expr) {
            $sum = DotbMath::init($sum)->add($expr->evaluate())->result();
            $count++;
        }

        // since Expression guarantees at least 1 parameter
        // we can safely assume / by 0 will not happen
        return DotbMath::init($sum)->div($count)->result();
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<JS
			var sum   = 0;
			var count = 0;
			var params = this.getParameters();
			for (var i = 0; i < params.length; i++) {
			    sum = this.context.add(sum, params[i].evaluate());
				count++;
			}
			// since Expression guarantees at least 1 parameter
			// we can safely assume / by 0 will not happen
			return this.context.divide(sum, count);
JS;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return array('average', 'avg');
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
