<?php


/**
 * <b>isInList(Generic item, List list)</b><br/>
 * Returns true if item is contained within the list. <br/>
 * <i>isInList(3, createList(2, 3, "red", "blue"))</i> = true
 */
class IsInEnumExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$params = $this->getParameters();
		$haystack = $params[1]->evaluate();
		$needle   = $params[0]->evaluate();

		foreach ( $haystack as $value ) {
			if ( $value instanceof Expression ) $value = $value->evaluate();
			if ( $value == $needle )	return AbstractExpression::$TRUE;
		}

		return AbstractExpression::$FALSE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters();
			var haystack = params[1].evaluate();
			var needle   = params[0].evaluate();

			for ( var i = 0 ; i < haystack.length ; i++ ) {
				var value = haystack[i];
				if ( value instanceof DOTB.expressions.Expression ) value = value.evaluate();
				if ( value == needle )	return DOTB.expressions.Expression.TRUE;
			}

			return DOTB.expressions.Expression.FALSE;
EOQ;
	}

	/**
	 * Any generic type will suffice.
	 */
	static function getParameterTypes() {
		return array("generic", "enum");
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 2;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return array("isInList", "isInEnum");
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
?>