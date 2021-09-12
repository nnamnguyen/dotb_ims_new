<?php


/**
 * <b>floor(Number n)</b><br>
 * Returns <i>n</i> rounded down to the next integer.<br/>
 * ex: <i>floor(5.73)</i> = 5
 */
class FloorExpression extends NumericExpression
{
    /**
     * Returns the negative of the expression that it contains.
     */
    public function evaluate()
    {
        return floor($this->getParameters()->evaluate());
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<EOQ
			return Math.floor( this.getParameters().evaluate() );
EOQ;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return "floor";
    }

    /**
     * Returns the exact number of parameters needed.
     */
    public static function getParamCount()
    {
        return 1;
    }
}
