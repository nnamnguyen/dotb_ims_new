<?php

/**
 * <b>abs(Number num)</b><br>
 * Returns the absolute value of <i>num</i>.
 * ex: <i>abs(-5)</i> = 5
 */
class AbsoluteValueExpression extends NumericExpression
{
    /**
	 * Returns the negative of the expression that it contains.
	 */
    public function evaluate()
    {
        return abs($this->getParameters()->evaluate());
    }

    /**
	 * Returns the JS Equivalent of the evaluate function.
	 */
    public static function getJSEvaluate()
    {
        return <<<EOQ
			return Math.abs(this.getParameters().evaluate());
EOQ;
    }

    /**
	 * Returns the operation name that this Expression should be
	 * called by.
	 */
    public static function getOperationName()
    {
        return "abs";
    }

    /**
	 * Returns the exact number of parameters needed.
	 */
    public static function getParamCount()
    {
        return 1;
    }
}
