<?php

abstract class RelateExpression extends AbstractExpression
{
	/**
	 * Parameters May be anything
	 */
    static function getParameterTypes() {
		return array(AbstractExpression::$ENUM_TYPE, AbstractExpression::$STRING_TYPE, AbstractExpression::$BOOLEAN_TYPE,
					 AbstractExpression::$DATE_TYPE, AbstractExpression::$NUMERIC_TYPE,  AbstractExpression::$GENERIC_TYPE);
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters();
			return params;
EOQ;
	}
}

?>