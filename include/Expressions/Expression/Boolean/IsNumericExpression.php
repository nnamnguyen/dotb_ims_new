<?php




/**
 * <b>isNumeric(String string)</b><br/>
 * Returns true if <i>string</i> contains only digits, <br/>
 * negative sign, or a decimal point.
 *
 */
class IsNumericExpression extends BooleanExpression
{
    /**
     * Returns itself when evaluating.
     */
    public function evaluate()
    {
        $params = $this->getParameters()->evaluate();
        if ($params === '' || is_null($params)) {
            return AbstractExpression::$FALSE;
        }
        if (preg_match('/^(\-)?([0-9]+)?(\.[0-9]+)?$/', $params)) {
            return AbstractExpression::$TRUE;
        }

        return AbstractExpression::$FALSE;
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<JS
            var params = this.getParameters().evaluate();
            if (params === '' || params === null) {
                return DOTB.expressions.Expression.FALSE
            }
            if (isFinite(params) && !isNaN(parseFloat(params))) {
                return DOTB.expressions.Expression.TRUE;
            }

            return DOTB.expressions.Expression.FALSE;
JS;
    }

    /**
     * Any generic type will suffice.
     */
    public static function getParameterTypes()
    {
        return array("string");
    }

    /**
     * Returns the maximum number of parameters needed.
     */
    public static function getParamCount()
    {
        return 1;
    }

    /**
     * Returns the opreation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return "isNumeric";
    }

    /**
     * Returns the String representation of this Expression.
     */
    public function toString()
    {
    }
}
