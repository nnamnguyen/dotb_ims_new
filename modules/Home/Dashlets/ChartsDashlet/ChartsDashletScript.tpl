{*

*}

<script>
    DOTB.util.doWhen(
		"DOTB && DOTB.myDotb && DOTB.myDotb.dotbCharts",
		function(){ldelim}
			DOTB.myDotb.dotbCharts.addToChartsArray('{$chartName}', '{$chartXMLFile}', '100%', '480', '{$chartStyleCSS}', '{$chartColorsXML}', '{$chartLangFile}');
		{rdelim}
	);
</script>
