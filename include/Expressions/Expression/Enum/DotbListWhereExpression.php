<?php


/**
 * <b>getListWhere(String trigger, Enum lists)</b><br>
 * Returns the matched array from lists.<br/>
 * ex: <i>getListWhere('C1', enum({lists}))</i>
 */
class DotbListWhereExpression extends EnumExpression
{
    /**
     * Returns the matched array.
     */
    function evaluate() {
        $params = $this->getParameters();
        $trigger = $params[0]->evaluate();
        $lists = $params[1]->evaluate();
        $array = array();
        foreach($lists as $list) {
            if (!empty($list)) {
                if ($list[0] == $trigger) {
                    $array = $list[1];
                    break;
                }
            }
        }
        return $array;
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    static function getJSEvaluate() {
        return <<<EOQ
        	var params = this.getParameters();
        	var trigger = params[0].evaluate();
        	var lists = params[1].evaluate();
        	var array = [];
        	for ( var i = 0; i < lists.length; i++ ) {
        	    if (lists[i].length > 0) {
        	        if (lists[i][0] == trigger) {
        	            array = lists[i][1];
        	            break;
        	        }
        	    }
        	}
        	return array == "undefined" ? [] : array;
EOQ;
    }


    /**
     * Returns the exact number of parameters needed.
     */
    static function getParamCount() {
        return 2;
    }

    /**
     * The first parameter is a string and the second is an enum.
     */
    static function getParameterTypes() {
        return array(AbstractExpression::$STRING_TYPE, AbstractExpression::$ENUM_TYPE);
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    static function getOperationName() {
        return "getListWhere";
    }

    /**
     * Returns the String representation of this Expression.
     */
    function toString() {
    }
}

?>
