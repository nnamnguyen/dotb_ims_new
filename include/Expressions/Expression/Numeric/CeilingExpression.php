<?php


/**
 * <b>ceil(Number n)</b><br>
 * Returns <i>n</i> rounded up to the next integer.<br/>
 * ex: <i>ceil(5.12)</i> = 6
 */
class CeilingExpression extends NumericExpression
{
    /**
     * Returns the negative of the expression that it contains.
     */
    public function evaluate()
    {
        return ceil($this->getParameters()->evaluate());
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<EOQ
			return Math.ceil(this.getParameters().evaluate());
EOQ;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return array("ceil", "ceiling");
    }

    /**
     * Returns the exact number of parameters needed.
     */
    public static function getParamCount()
    {
        return 1;
    }
}
