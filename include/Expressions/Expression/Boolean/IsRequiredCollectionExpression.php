<?php

/**
 * <b>isRequiredCollection(String table)</b><br/>
 * Returns true none of the fields under html element <i>table</i> are empty.
 */
class IsRequiredCollectionExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$params = $this->getParameters();
		$val = $params[0]->evaluate();
	    return AbstractExpression::$TRUE;

		//return AbstractExpression::$FALSE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters().evaluate();
            table = document.getElementById(params);
            children = YAHOO.util.Dom.getElementsByClassName('sqsEnabled', 'input', table);
            for(id in children) {
                if(trim(children[id].value) != '') {
                   return DOTB.expressions.Expression.TRUE;
                }
            }
			return DOTB.expressions.Expression.FALSE;
EOQ;
	}

	/**
	 * Any generic type will suffice.
	 */
	static function getParameterTypes() {
		return array("string");
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 1;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "isRequiredCollection";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>