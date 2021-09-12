<?php


/**
 * <b>ln(Number n)</b><br/>
 * Returns the natural log of <i>n</i>.
 * ex: <i>ln(e)</i> = 1
 */
class NaturalLogExpression extends NumericExpression
{
    /**
     * Returns itself when evaluating.
     */
    public function evaluate()
    {
        return log($this->getParameters()->evaluate());
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<EOQ

            return Math.log( this.getParameters().evaluate() );
EOQ;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return "ln";
    }

    /**
     * Returns the exact number of parameters needed.
     */
    public static function getParamCount()
    {
        return 1;
    }
}
