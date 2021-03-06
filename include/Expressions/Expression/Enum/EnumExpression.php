<?php

abstract class EnumExpression extends AbstractExpression
{
	/**
	 * Validates the parameters and throws an Exception if invalid.
	 *
	function validateParameters() {
		$params = $this->getParameters();
		$count  = $this->getParamCount();
		$types  = $this->getParameterTypes();

		// make sure count is a number
		if ( !is_numeric($count) )	throw new Exception($this->getOperationName() . ": Number of paramters required must be a number.");

		// make sure types is a array or string
		if ( ( !is_string($types) && !is_array($types) ) || ( $types != AbstractExpression::$BOOLEAN_TYPE && $count != AbstractExpression::$INFINITY && $count != sizeof($types) ) )
			throw new Exception($this->getOperationName() . ": Parameter types must be valid and match the parameter count.");

		// if we require 0 parameters but we still have parameters
		if ( $count == 0 && isset($params) )	throw new Exception($this->getOperationName() . ": Does not require any parameters.");

		// we require multiple but params only has 1
		if ( $count > 1 && !is_array($params) )	throw new Exception($this->getOperationName() . ": Requires exactly $count parameter(s).");

		// if params is just a string, and we require a single string
		if ( $count == 1 && $types == AbstractExpression::$ENUM_TYPE && ( $this->is_array($params) || $params instanceof Expression ) )
			return;

		// we require only 1 and params has multiple
		if ( $count == 1 && is_array($params) )	throw new Exception($this->getOperationName() . ": Requires exactly $count parameter(s).");

		// check parameter range
		if ( $count != AbstractExpression::$INFINITY && sizeof($params) != $count )
			throw new Exception($this->getOperationName() . ": Requires exactly $count parameter(s).");

		if ( $types == AbstractExpression::$ENUM_TYPE ) {
			// make sure all parameters are typeof StringExpression or a string literal
			foreach ( $params as $param ) {
				if ( ! $param instanceof Expression && ! $param != AbstractExpression::$TRUE && $param != AbstractExpression::$FALSE  )
					throw new Exception($this->getOperationName() . ": All parameters must be of proper types $param.");
			}
		} else {
			for ( $i = 0 ; $i < sizeof($types) ; $i++ ) {
				$type  = $types[$i];
				$param = $params[$i];

				// invalid type
				if ( empty(AbstractExpression::$TYPE_MAP[$type]) )
					throw new Exception($this->getOperationName() . ": invalid type specified $type.");

				// improper type
				if ( ! ( $param instanceof AbstractExpression::$TYPE_MAP[$type] ) )
					throw new Exception($this->getOperationName() . ": the parameter at index $i must be of type $type.");
			}
		}
	}*/

	/**
	 * All parameters have to be a string.
	 */
    static function getParameterTypes() {
		return array(AbstractExpression::$ENUM_TYPE, AbstractExpression::$STRING_TYPE, AbstractExpression::$BOOLEAN_TYPE,
					 AbstractExpression::$DATE_TYPE, AbstractExpression::$NUMERIC_TYPE);
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters();
			var array = new Array();
			for ( var i = 0; i < params.length; i++ ) {
				array[array.length] = params[i].evaluate();
			}
			return array;
EOQ;
	}
}

?>