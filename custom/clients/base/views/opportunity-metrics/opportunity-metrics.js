/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 */
({
    plugins: ['Dashlet', 'Chart'],
    className: 'opportunity-metrics-wrapper',
    metricsCollection: null,
    initialize: function(options) {
        this._super('initialize', [options]);
        this.chart = nv.models.pieChart().x(function(d) {
            return d.key;
        }).y(function(d) {
            return d.value;
        }).margin({
            top: 0,
            right: 0,
            bottom: 5,
            left: 0
        }).donut(true).donutLabelsOutside(true).donutRatio(0.447).hole(this.total).showTitle(false).tooltips(true).showLegend(false).colorData('data').direction(app.lang.direction).tooltipContent(function(key, x, y, e, graph) {
            return '<p><b>' + key + ' ' + parseInt(y, 10) + '</b></p>';
        }).strings({
            noData: app.lang.get('LBL_CHART_NO_DATA')
        });
    },
    renderChart: function() {
        if (!this.isChartReady()) {
            return;
        }
        this.chart.hole(this.total);
        d3.select(this.el).select('svg#' + this.cid).datum(this.chartCollection).transition().duration(500).call(this.chart);
        this.chart_loaded = _.isFunction(this.chart.update);
        this.displayNoData(!this.chart_loaded);
    },
    evaluateResult: function(data) {
        var total = 0;
        _.each(data, function(value, key) {

            var formatted = app.currency.formatAmountLocale(value.amount_usdollar, null, 0);
            if (formatted.substr(0, 1) == '\u20AC') {
                formatted = formatted.substr(1, formatted.length-1) + formatted.substr(0, 1);
            }

            data[key].formattedAmount = formatted;
            data[key].icon = key === 'won' ? 'caret-up' : (key === 'lost' ? 'caret-down' : 'minus');
            data[key].cssClass = key === 'won' ? 'won' : (key === 'lost' ? 'lost' : 'active');
            data[key].dealLabel = key;
            data[key].stageLabel = app.lang.getAppListStrings('opportunity_metrics_dom')[key];
            total += value.count;
        });
        this.total = total;
        this.metricsCollection = data;
        this.chartCollection = {
            data: _.map(this.metricsCollection, function(value, key) {
                return {
                    'key': value.stageLabel,
                    'value': value.count,
                    'classes': key
                };
            }),
            properties: {
                title: app.lang.get('LBL_DASHLET_OPPORTUNITY_NAME'),
                value: 3,
                label: total
            }
        };
    },
    loadData: function(options) {
        var self = this,
            url;
        if (this.meta.config) {
            return;
        }
        url = app.api.buildURL(this.model.module, 'opportunity_stats', {
            id: this.model.get('id')
        });
        app.api.call('read', url, null, {
            success: function(data) {
                self.evaluateResult(data);
                if (!self.disposed) {
                    self.render();
                }
            },
            error: _.bind(function() {
                this.displayNoData(true);
            }, this),
            complete: options ? options.complete : null
        });
    }
})