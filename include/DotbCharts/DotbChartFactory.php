<?php


/**
 * Chart factory
 * @api
 */
class DotbChartFactory
{
    /**
	 * Returns a reference to the ChartEngine object for instance $chartEngine, or the default
     * instance if one is not specified
     *
     * @param string $chartEngine optional, name of the chart engine from $dotb_config['chartEngine']
     * @param string $module optional, name of module extension for chart engine (see JitReports or DotbFlashReports)
     * @return object ChartEngine instance
     */
    public static function getInstance($chartEngine = '', $module = '')
    {
        global $dotb_config;
        $defaultEngine = "sucrose";
        //fall back to the default Js Engine if config is not defined
        if (empty($dotb_config['chartEngine'])) {
            $dotb_config['chartEngine'] = $defaultEngine;
        }

        if (empty($chartEngine)) {
            $chartEngine = $dotb_config['chartEngine'];
        }

        if (!DotbAutoLoader::requireWithCustom("include/DotbCharts/{$chartEngine}/{$chartEngine}{$module}.php")) {
            $GLOBALS['log']->debug("using default engine include/DotbCharts/{$defaultEngine}/{$defaultEngine}{$module}.php");
            require_once("include/DotbCharts/{$defaultEngine}/{$defaultEngine}{$module}.php");
            $chartEngine = $defaultEngine;
        }

        $className = $chartEngine.$module;
        return new $className();

    }
}
