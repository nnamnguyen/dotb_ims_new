<?php


/**
 * <b>and(boolean1, ...)</b><br>
 * Returns true if and only if all parameters are true.<br/>
 * ex: <i>and(true, true)</i> = true, <i>and(true, false)</i> = false
 */
class AndExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$params = $this->getParameters();
        if (!is_array($params)) $params = array($params);
		foreach ( $params as $param ) {
			if ( $param->evaluate() != AbstractExpression::$TRUE )
				return AbstractExpression::$FALSE;
		}
		return AbstractExpression::$TRUE;
	}
	
	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters();
            if(!(params instanceof Array)) params = [params];
			for ( var i = 0; i < params.length; i++ ) {
				if ( params[i].evaluate() != DOTB.expressions.Expression.TRUE )
					return DOTB.expressions.Expression.FALSE;
			}
			return DOTB.expressions.Expression.TRUE;
EOQ;
	}
	
	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "and";
	}
	
	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>