<?php


abstract class DotbForecasting_Progress_AbstractProgress extends DotbForecasting_AbstractForecastArgs implements DotbForecasting_ForecastProcessInterface
{
    /**
     * Class Constructor
     * @param array $args       Service Arguments
     */
    public function __construct($args)
    {
        parent::__construct($args);

        $this->loadConfigArgs();
    }

    /**
     * Get Settings from the Config Table.
     */
    public function loadConfigArgs() {
        /* @var $admin Administration */
        $admin = Administration::getSettings();
        $settings = $admin->getConfigForModule('Forecasts');
        // decode and json decode the settings from the administration to set the sales stages for closed won and closed lost
        $this->setArg('sales_stage_won', $settings["sales_stage_won"]);
        $this->setArg('sales_stage_lost', $settings["sales_stage_lost"]);
    }
}
