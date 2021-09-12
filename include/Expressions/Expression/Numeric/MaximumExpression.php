<?php


/**
 * <b>max(Number num, ...)</b><br/>
 * Returns highest value number passed in<br>
 * ex: <i>max(-4, 2, 3)</i> = 3
 */
class MaximumExpression extends NumericExpression
{
    /**
     * Returns the largest value in a set
     */
    public function evaluate()
    {
        $params = $this->getParameters();

        $max = false;
        foreach ($this->getParameters() as $expr) {
            $val = $expr->evaluate();
            if ($max === false || $val > $max) {
                $max = $val;
            }
        }

        return $max;
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<EOQ
			var params = this.getParameters();
			var max = null;
			for (var i = 0; i < params.length; i++) {
				var val = 	params[i].evaluate();
				if(max == null || val > max)
					max = val;
			}
			return max;
EOQ;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return "max";
    }
}
