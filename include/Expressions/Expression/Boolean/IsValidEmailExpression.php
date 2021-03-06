<?php


/**
 * <b>isValidEmail(String email)</b><br/>
 * Returns true if <i>email</i> is in a valid email address format. <br/>
 * ex: <i>isValidEmail("invalid@zxcv")</i> = false,<br/>
 * <i>isValidEmail("good@test.com")</i> = true
 */
class IsValidEmailExpression extends BooleanExpression {
	/**
	 * Returns itself when evaluating.
	 */
	function evaluate() {
		$emailStr = $this->getParameters()->evaluate();

		if ($emailStr == "")
            return AbstractExpression::$TRUE;

        $lastChar = $emailStr[strlen($emailStr) - 1];
		if ( !preg_match('/[^\.]/i', $lastChar) )	return AbstractExpression::$FALSE;

		// validate it
		$emailArr = preg_split('/[,;]/', $emailStr);
		for ( $i = 0; $i < sizeof($emailArr) ; $i++) {
            $emailAddress = trim($emailArr[$i]);
            if ($emailAddress != '' && !DotbEmailAddress::isValidEmail($emailAddress)) {
                return AbstractExpression::$FALSE;
            }
		}

		return AbstractExpression::$TRUE;
	}

	/**
	 * Returns the JS Equivalent of the evaluate function.
     *
     * Only performs a very basic validation because the complexity of the server-side regular expression is too great
     * to mirror on the client, both in terms of maintenance and difficulty in porting to a different engine. Even if
     * the light-weight validation passes, the server-side validation may fail.
	 */
	static function getJSEvaluate() {
		return <<<EOQ
		var emailStr = this.getParameters().evaluate();
		
		if ( typeof emailStr != "string" ) return DOTB.expressions.Expression.FALSE;

		if ( emailStr == "" ) return DOTB.expressions.Expression.TRUE;
		
		var lastChar = emailStr.charAt(emailStr.length - 1);
		if ( !lastChar.match(/[^\.]/i) )	return DOTB.expressions.Expression.FALSE;

		// validate it
		var emailArr = emailStr.split(/[,;]/);		// if multiple e-mail addresses
		for (var i = 0; i < emailArr.length; i++) {
			var emailAddress = emailArr[i];
			emailAddress = emailAddress.replace(/^\s+|\s+$/g,"");
            if (emailAddress != '' &&
                !/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@\S+$/.test(emailAddress)
            ) {
                return DOTB.expressions.Expression.FALSE;
            }
		}

		return DOTB.expressions.Expression.TRUE;
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
		return "isValidEmail";
	}

	/**
	 * Returns the String representation of this Expression.
	 */
	function toString() {
	}
}
