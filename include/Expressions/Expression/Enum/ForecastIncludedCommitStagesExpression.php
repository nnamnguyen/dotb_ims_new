<?php


/**
 * <b>forecastIncludedCommitStages()</b><br/>
 * Returns all the included commit stages for the Forecast Module<br/>
 * ex: <i>forecastIncludedCommitStages()</i>
 */
class ForecastIncludedCommitStagesExpression extends EnumExpression
{
    /**
     * Returns the entire enumeration bare.
     */
    public function evaluate()
    {
        // get the statuses
        $settings = Forecast::getSettings();

        return $settings['commit_stages_included'];
    }


    /**
     * Returns the JS Equivalent of the evaluate function.
     */
    public static function getJSEvaluate()
    {
        return <<<JS

            // this doesn't support BWC modules, so it should return the full list of dom elememnts
            if (App === undefined) {
                return DOTB.language.get('app_list_strings', 'sales_stage_dom');
            }

            var config = App.metadata.getModule('Forecasts', 'config');

            return config.commit_stages_included;
JS;
    }

    public static function getParamCount()
    {
        return 0;
    }


    /**
     * The first parameter is a number and the second is the list.
     */
    public static function getParameterTypes()
    {
        return array();
    }

    /**
     * Returns the operation name that this Expression could be called by.
     */
    public static function getOperationName()
    {
        return array("forecastIncludedCommitStages");
    }
}
