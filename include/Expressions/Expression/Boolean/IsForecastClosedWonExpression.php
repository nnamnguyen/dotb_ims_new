<?php



/**
 * <b>isForecastClosedWon(String $status)</b><br>
 * Returns true if $status is in the forecast config for sales_stage_won
 */
class isForecastClosedWonExpression extends BooleanExpression
{
    /**
     * Returns itself when evaluating.
     */
    public function evaluate()
    {
        $value = $this->getParameters()->evaluate();

        // get the statuses
        $settings = Forecast::getSettings();

        if (in_array($value, $settings['sales_stage_won'], true)) {
            return AbstractExpression::$TRUE;
        }

        return AbstractExpression::$FALSE;
    }

    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<JS
			var value = this.getParameters().evaluate();

			// this doesn't support BWC modules, so it should return false if it doesn't have app.
			// we can't use undersore as it's not in BWC mode here
			if (App === undefined) {
		        return DOTB.expressions.Expression.FALSE;
			}

			var config = App.metadata.getModule('Forecasts', 'config') || {},
			    status = config.sales_stage_won || ['Closed Won'];

            if (status.indexOf(value) === -1) {
                return DOTB.expressions.Expression.FALSE
            }

			return DOTB.expressions.Expression.TRUE;
JS;
    }

    /**
     * Any generic type will suffice.
     */
    public static function getParameterTypes()
    {
        return array('string');
    }

    /**
     * Returns the maximum number of parameters needed.
     */
    public static function getParamCount()
    {
        return 1;
    }

    /**
     * Returns the operation name that this Expression should be
     * called by.
     */
    public static function getOperationName()
    {
        return 'isForecastClosedWon';
    }

    /**
     * Returns the String representation of this Expression.
     */
    public function toString()
    {
    }
}