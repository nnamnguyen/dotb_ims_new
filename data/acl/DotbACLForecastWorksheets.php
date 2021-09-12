<?php




class DotbACLForecastWorksheets extends DotbACLStrategy
{
    /**
     * @var RevenueLineItem|Opportunity|DotbBean
     */
    protected static $forecastByBean;

    /**
     * Run the check Access for this custom ACL helper.
     *
     * @param string $module
     * @param string $view
     * @param array $context
     * @return bool
     */
    public function checkAccess($module, $view, $context)
    {
        if ($module != 'ForecastWorksheets') {
            return false;
        }

        if ($view == 'team_security') {
            // Let the other modules decide
            return true;
        }

        // Let's make it a little easier on ourselves and fix up the actions nice and quickly
        $view = DotbACLStrategy::fixUpActionName($view);
        $bean = $this->getForecastByBean();
        $current_user = $this->getCurrentUser($context);

        if (empty($view) || empty($current_user->id)) {
            return true;
        }

        if ($view == 'field') {
            // Opp Bean, Amount Field = Likely Case on worksheet
            if ($bean instanceof Opportunity && $context['field'] == 'likely_case') {
                $context['field'] = 'amount';
            }

            // always set the bean to the context
            $context['bean'] = $bean;
            // make sure the user has access to the field
            return $bean->ACLFieldAccess($context['field'], $context['action'], $context);
        }

        return true;
    }

    /**
     * Return the bean for what we are forecasting by
     *
     * @return RevenueLineItem|Opportunity|DotbBean
     */
    protected function getForecastByBean()
    {
        if (!(static::$forecastByBean instanceof DotbBean)) {
            /* @var $admin Administration */
            $admin = BeanFactory::newBean('Administration');
            $settings = $admin->getConfigForModule('Forecasts');

            // if we don't have the forecast_by from the db, grab the defaults that we use on set.
            if (empty($settings['forecast_by'])) {
                $settings = ForecastsDefaults::getDefaults();
            }

            $bean = $settings['forecast_by'];

            static::$forecastByBean = BeanFactory::newBean($bean);
        }

        return static::$forecastByBean;
    }
}
