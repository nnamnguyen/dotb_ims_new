<?php


/**
 * <b>Log(number, base)</b><br/>
 * Returns the supplied </i>base</i> Log of <i>number</i>.<br>
 * ex: <em>log(100, 10)</em> = 2
 */
class LogExpression extends NumericExpression
{
    /**
     * Returns itself when evaluating.
     */
    public function evaluate()
    {
        $params = $this->getParameters();
        $base = $params[1]->evaluate();
        $value = $params[0]->evaluate();
        if ($base == 1) {
            throw new Exception("Log base can not be 1");
        }

        return DotbMath::init(log($value))->div(log($base))->result();
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<EOQ
		      var params = this.getParameters();

            var base = params[1].evaluate();
            var value = params[0].evaluate();

            return this.context.divide(Math.log(value), Math.log(base));
EOQ;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return "log";
    }

    /**
     * Returns the exact number of parameters needed.
     */
    public static function getParamCount()
    {
        return 2;
    }
}
