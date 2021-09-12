

/**
 * This chart engine is now deprecated. Use the sucrose chart engine instead.
 * @deprecated This file will removed in a future release.
 */
initmyDotbCharts = function() {

    DOTB.myDotb.dotbCharts = function() {
        (app || DOTB.App).logger.warn('The nvd3 chart engine is deprecated.');

        var activeTab = activePage,
            charts = {};

        return {
            loadDotbCharts: function(activeTab) {
                var chartFound = false;

                for (var id in charts[activeTab]) {
                    if (id !== 'undefined') {
                        chartFound = true;
                        loadDotbChart(
                            charts[activeTab][id]['chartId'], charts[activeTab][id]['jsonFilename'], charts[activeTab][id]['css'], charts[activeTab][id]['chartConfig']);
                    }
                }
                //clear charts array
                charts = {};
            },

            addToChartsArrayJson: function(json, activeTab) {
                for (var id in json) {
                    if (json[id]['supported'] === 'true') {
                        DOTB.myDotb.dotbCharts.addToChartsArray(
                            json[id]['chartId'],
                            json[id]['filename'],
                            json[id]['css'],
                            json[id]['chartConfig'],
                            activeTab
                        );
                    }
                }
            },

            addToChartsArray: function(chartId, jsonFilename, css, chartConfig, activeTab) {
                if (!charts[activeTab]) {
                    charts[activeTab] = {};
                }
                charts[activeTab][chartId] = {};
                charts[activeTab][chartId]['chartId'] = chartId;
                charts[activeTab][chartId]['jsonFilename'] = jsonFilename;
                charts[activeTab][chartId]['css'] = css;
                charts[activeTab][chartId]['chartConfig'] = chartConfig;
            }
        };
    }();
};
