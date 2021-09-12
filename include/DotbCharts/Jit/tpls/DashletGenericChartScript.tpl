{*

*}

<script>
DOTB.util.doWhen(
	"DOTB && DOTB.myDotb && DOTB.myDotb.dotbCharts",
	function(){ldelim}
		var customChart = true;
		var css = new Array();
		var chartConfig = new Array();
		{foreach from=$css key=selector item=property}
		css["{$selector}"] = '{$property}';
		{/foreach}
		{foreach from=$config key=name item=value}
		chartConfig["{$name}"] = '{$value}';
		{/foreach}
    	DOTB.myDotb.dotbCharts.addToChartsArray('{$chartId}','{$filename}',css,chartConfig,activePage);
		{rdelim}
	);
</script>