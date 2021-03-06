<?php


/**
 * <b>ifElse(Boolean c, Val1, Val2)</b><br>
 * Returns <i>Val1</i> if <i>c</i> is true<br/>
 * or <i>Val2</i> if <i>c</i> is false.<br/>
 * ex: <i>ifElse(true, "first", "second") = "first"</i><br/>
 * <i>ifElse(false, "first", "second")</i> = "second"
 */
class ConditionExpression extends GenericExpression
{
    /**
     * Returns the entire enumeration bare.
     */
    function evaluate()
    {
        $params = $this->getParameters();
        $cond = $params[0]->evaluate();
        if ($cond == AbstractExpression::$TRUE) {
            return $params[1]->evaluate();
        } else {
            return $params[2]->evaluate();
        }
    }


    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    static function getJSEvaluate()
    {
        return <<<EOQ
            var SEE = DOTB.expressions.Expression,
                params = this.getParameters(),
                cond = params[0].evaluate();
            if (SEE.isTruthy(cond)) {
                return params[1].evaluate();
            } else {
                return params[2].evaluate();
            }
EOQ;
    }

    /**
     * Returns the opreation name that this Expression should be
     * called by.
     */
    static function getOperationName()
    {
        return array('ifElse', 'cond');
    }

    /**
     * The first parameter is a number and the second is the list.
     */
    static function getParameterTypes()
    {
        return array(
            AbstractExpression::$BOOLEAN_TYPE,
            AbstractExpression::$GENERIC_TYPE,
            AbstractExpression::$GENERIC_TYPE
        );
    }

    /**
     * Returns the maximum number of parameters needed.
     */
    static function getParamCount()
    {
        return 3;
    }

    /**
     * Returns the String representation of this Expression.
     */
    function toString()
    {
    }
}
