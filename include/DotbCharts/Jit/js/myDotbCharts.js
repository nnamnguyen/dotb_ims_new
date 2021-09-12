


/**
 * This chart engine is now deprecated. Use the sucrose chart engine instead.
 * @deprecated This file will removed in a future release.
 */
initmyDotbCharts = function(){

DOTB.myDotb.dotbCharts = function() {
    (app || DOTB.App).logger.warn('The Jit chart engine is deprecated.');

var activeTab = activePage,
    charts = new Object();

	return {
		loadDotbCharts: function(activeTab) {
			var chartFound = false;

			for (id in charts[activeTab]){
				if(id != 'undefined'){
					chartFound = true;
					loadDotbChart(
											 charts[activeTab][id]['chartId'],
											 charts[activeTab][id]['jsonFilename'],
											 charts[activeTab][id]['css'],
											 charts[activeTab][id]['chartConfig']
											 );
				}
			}
			//clear charts array
			charts = new Object();

		},

		addToChartsArrayJson: function(json,activeTab) {
			for (id in json) {
					if(json[id]['supported'] == "true") {
						DOTB.myDotb.dotbCharts.addToChartsArray(
												 json[id]['chartId'],
 												 json[id]['filename'],
												 json[id]['css'],
												 json[id]['chartConfig'],
												 activeTab);
					}
				}
		},
		addToChartsArray: function(chartId,jsonFilename,css,chartConfig,activeTab) {

			if (charts[activeTab] == null){
				charts[activeTab] = new Object();
			}
			charts[activeTab][chartId] = new Object();
			charts[activeTab][chartId]['chartId'] = chartId;
			charts[activeTab][chartId]['jsonFilename'] = jsonFilename;
			charts[activeTab][chartId]['css'] = css;
			charts[activeTab][chartId]['chartConfig'] = chartConfig;

		}
	}
}();
};
