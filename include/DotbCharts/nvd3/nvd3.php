<?php



/**
 * This chart engine is now deprecated. Use the sucrose chart engine instead.
 * @deprecated This file will removed in a future release.
 */
class nvd3 extends JsChart
{

    var $supports_image_export = true;
    var $print_html_legend_pdf = false;

    function __construct()
    {
        parent::__construct();
    }

    function getChartResources()
    {
        return '
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/nvd3/lib/d3.min.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/nvd3/nv.d3.min.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/rgbcolor.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/StackBlur.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/javascript/canvg.js').'"></script>
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/DotbCharts/nvd3/js/dotbCharts.js').'"></script>
        ';
    }

    function getMyDotbChartResources()
    {
        return '
        <script language="javascript" type="text/javascript" src="'.getJSPath('include/DotbCharts/nvd3/js/myDotbCharts.js').'"></script>
        ';
    }

    function display($name, $xmlFile, $width = '320', $height = '480', $resize = false)
    {
        $GLOBALS['log']->deprecated('The nvd3 chart engine is deprecated.');

        parent::display($name, $xmlFile, $width, $height, $resize);

        return $this->ss->fetch('include/DotbCharts/nvd3/tpls/chart.tpl');
    }

    function getDashletScript($id, $xmlFile = "")
    {
        parent::getDashletScript($id, $xmlFile);
        return $this->ss->fetch('include/DotbCharts/nvd3/tpls/DashletGenericChartScript.tpl');
    }
}
