<?php




/**
 * This chart engine is now deprecated. Use the sucrose chart engine instead.
 * @deprecated This file will removed in a future release.
 */
class Jit extends JsChart {

	var $supports_image_export = true;
	var $print_html_legend_pdf = true;

	function __construct() {
		parent::__construct();
	}

	function getChartResources() {
		return '
		<script language="javascript" type="text/javascript" src="'.getJSPath('include/DotbCharts/Jit/js/Jit/jit.js').'"></script>
		<script language="javascript" type="text/javascript" src="'.getJSPath('include/DotbCharts/Jit/js/dotbCharts.js').'"></script>
		';
	}

	function getMyDotbChartResources() {
		return '
		<script language="javascript" type="text/javascript" src="'.getJSPath('include/DotbCharts/Jit/js/myDotbCharts.js').'"></script>
		';
	}


	function display($name, $xmlFile, $width='320', $height='480', $resize=false) {
        $GLOBALS['log']->deprecated('The Jit chart engine is deprecated.');

		parent::display($name, $xmlFile, $width, $height, $resize);

		return $this->ss->fetch('include/DotbCharts/Jit/tpls/chart.tpl');
	}


	function getDashletScript($id,$xmlFile="") {

		parent::getDashletScript($id,$xmlFile);
		return $this->ss->fetch('include/DotbCharts/Jit/tpls/DashletGenericChartScript.tpl');
	}




}

?>
