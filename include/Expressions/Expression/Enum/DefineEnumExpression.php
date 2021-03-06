<?php

/**
 * <b>createList(v1, ...)</b><br/>
 * Returns a list made up of the passed in variables.<br/>
 * ex: <i>createList(123, "Hello World", "three", 4.5)</i>
 */
class DefineEnumExpression extends EnumExpression
{
	/**
	 * Returns the entire enumeration bare.
	 */
	function evaluate() {
		$params = $this->getParameters();
		$array  = array();

		if (is_array($params)) 
		{
			foreach ( $params as $param ) {
				$array[] = $param->evaluate();
			} 
		}
		else {
			$array[] = $params->evaluate();
		}

		return $array;
	}


	/**
	 * Returns the JS Equivalent of the evaluate function.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
			var params = this.getParameters();
			var array = [];
			if (typeof(params.length) != "undefined")
			{
				for ( var i = 0; i < params.length; i++ ) {
					array[array.length] = params[i].evaluate();
				}
			} else {
				return [params.evaluate()];
			}
			return array;
EOQ;
	}


	/**
	 * The first parameter is a number and the second is the list.
	 */
    static function getParameterTypes() {
		return AbstractExpression::$GENERIC_TYPE;
	}

	/**
	 * Returns the opreation name that this Expression should be
	 * called by.
	 */
	static function getOperationName() {
		return array("createList", "enum");
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}

?>