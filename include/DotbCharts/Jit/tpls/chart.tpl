{*

*}

{if !$error}
<script type="text/javascript">
	{literal}
	DOTB.util.doWhen(
		"((DOTB && DOTB.myDotb && DOTB.myDotb.dotbCharts)   || (DOTB.loadChart && typeof loadDotbChart == 'function')  || document.getElementById('showHideChartButton') != null) && typeof(loadDotbChart) != undefined",
		function(){
			{/literal}
			var css = new Array();
			var chartConfig = new Array();
			{foreach from=$css key=selector item=property}
				css["{$selector}"] = '{$property}';
			{/foreach}
			{foreach from=$config key=name item=value}
				chartConfig["{$name}"] = '{$value}';
			{/foreach}
			{if $height > 480}
				chartConfig["scroll"] = true;
			{/if}
			loadCustomChartForReports = function(){ldelim}
				loadDotbChart('{$chartId}','{$filename}',css,chartConfig);
			{rdelim};
			// bug51857: fixed issue on report running in a loop when clicking on hide chart then run report in IE8 only
			// When hide chart button is clicked, the value of element showHideChartButton is set to $showchart.
			// Don't need to call the loadCustomChartForReports() function when hiding the chart.
			{if !isset($showchart)}
				loadCustomChartForReports();
			{else}
			     if($('#showHideChartButton').attr('value') != '{$showchart}')
			        loadCustomChartForReports();
			{/if}
			{literal}
		}
	);
	{/literal}
</script>

<div class="chartContainer">
	<div id="sb{$chartId}" class="scrollBars">
    <div id="{$chartId}" class="chartCanvas" style="width: {$width}; height: {$height}px;"></div>  
    </div>
	<div id="legend{$chartId}" class="legend"></div>
</div>
<div class="clear"></div>
{else}

{$error}
{/if}