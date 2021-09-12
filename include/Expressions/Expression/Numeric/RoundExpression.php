<?php


/**
 * <b>round(Number n, Number p)</b><br/>
 * Returns </i>n</i> to the <i>p</i> precision.<br/>
 * ex: <i>round('3.666666', 2)</i> = 3.67
 */
class RoundExpression extends NumericExpression
{
    /**
     * Rounds the first param down into a specific precision
     */
    public function evaluate()
    {
        $params = $this->getParameters();

        $base = $params[0]->evaluate();
        $precision = $params[1]->evaluate();

        return DotbMath::init($base, $precision)->result();
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<JS
			var params = this.getParameters();

			var base = params[0].evaluate();
			var precision = params[1].evaluate();

			return this.context.round(base, precision);
JS;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return array('round');
    }

    /**
     * Returns the exact number of parameters needed.
     */
    public static function getParamCount()
    {
        return 2;
    }
}
