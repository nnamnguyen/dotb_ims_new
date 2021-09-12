<?php


/**
 * <b>negate(Number n)</b><br/>
 * Returns negated value of <i>n</i>.
 * ex: <i>negate(4)</i> = -4
 */
class NegateExpression extends NumericExpression
{
    /**
     * Returns the negative of the expression that it contains.
     */
    public function evaluate()
    {
        return DotbMath::init('-1')->mul($this->getParameters()->evaluate())->result();
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<EOQ
			return this.context.multiply('-1', this.getParameters().evaluate());
EOQ;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return "negate";
    }

    /**
     * Returns the exact number of parameters needed.
     */
    public static function getParamCount()
    {
        return 1;
    }
}
