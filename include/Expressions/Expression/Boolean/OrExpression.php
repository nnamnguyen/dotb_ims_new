<?php


/**
 * <b>or(boolean1, ...)</b><br>
 * Returns true if any parameters are true.<br/>
 * ex: <i>or(false, true)</i> = true
 */
class OrExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {

		$params = $this->getParameters();
		
		if (!is_array($params))
		{
			$params = array($params);	
		}

		foreach ( $params as $param ) 
		{
			if ( $param->evaluate() == AbstractExpression::$TRUE )
			{
				return AbstractExpression::$TRUE;
			}
		}
		return AbstractExpression::$FALSE;
	}
	
	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters();		
			for ( var i = 0; i < params.length; i++ ) {
				if ( params[i].evaluate() == DOTB.expressions.Expression.TRUE )
					return DOTB.expressions.Expression.TRUE;
			}
			return DOTB.expressions.Expression.FALSE;
EOQ;
	}
	
	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "or";
	}
	
	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>