<?php


class StringLiteralExpression extends StringExpression {
	
	/**
	 * Returns the negative of the expression that it contains.
	 */
	function evaluate() {
		return $this->getParameters();
	}
	
	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			return this.getParameters();
EOQ;
	}
	
	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return "";
	}

	/**
	 * Returns the maximum number of parameters needed.
	 */
	static function getParamCount() {
		return 1;
	}
}
?>