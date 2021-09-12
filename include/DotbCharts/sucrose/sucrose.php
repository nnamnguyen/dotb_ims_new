<?php


/**
 * Instance of DotbChart specifically for Sucrose library
 * @api
 */
class sucrose extends JsChart
{
    public $supports_image_export = true;

    /**
     * Call the parent object contructor
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all of the Javascript resources that are needed to display a chart
     *
     * @return  string A concatenated list of script tags with compiled resource paths
     */
    function getChartResources()
    {
        return '
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/d3-dotb/d3-dotb.min.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/sucrose/sucrose.min.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/rgbcolor.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/StackBlur.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/canvg.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/DotbCharts/sucrose/js/dotbCharts.js').'"></script>
        ';
    }

    /**
     * Display method to invoke Smarty instance with template variables
     *
     * @param   string $name chart id assigned for template
     * @param   string $xmlFile chart data in xml format to be processed
     * @param   string $width default width of chart container
     * @param   string $height default height of chart container
     * @param   string $resize allow resizing of chart container (deprecated)
     * @return  string Smarty template instance with chart containers and source files
     */
    function display($name, $xmlFile, $width = '320', $height = '480', $resize = false)
    {
        parent::display($name, $xmlFile, $width, $height, $resize);

        return $this->ss->fetch('include/DotbCharts/sucrose/tpls/chart.tpl');
    }
}
