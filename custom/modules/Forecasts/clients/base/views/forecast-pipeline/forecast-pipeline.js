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
    results: {},
    chart: {},
    plugins: ['Dashlet', 'Chart', 'Tooltip'],
    forecastSetup: 0,
    forecastsNotSetUpMsg: undefined,
    isManager: false,
    initialize: function(options) {
        this.isManager = app.user.get('is_manager');
        this._initPlugins();
        this._super('initialize', [options]);
        this.forecastSetup = app.metadata.getModule('Forecasts', 'config').is_setup;
    },
    initDashlet: function(view) {
        if (!this.isManager && this.meta.config) {
            this.meta.panels = _.chain(this.meta.panels).filter(function(panel) {
                panel.fields = _.without(panel.fields, _.findWhere(panel.fields, {
                    name: 'visibility'
                }));
                return panel;
            }).value();
        }
        if (this.forecastSetup) {
            app.api.call('GET', app.api.buildURL('TimePeriods/current'), null, {
                success: _.bind(function(currentTP) {
                    this.settings.set({
                        'selectedTimePeriod': currentTP.id
                    }, {
                        silent: true
                    });
                    this.layout.loadData();
                }, this),
                error: _.bind(function() {}, this),
                complete: view.options ? view.options.complete : null
            });
        } else {
            this.settings.set({
                'selectedTimePeriod': 'current'
            }, {
                silent: true
            });
        }
        this.chart = nv.models.funnelChart().showTitle(false).tooltips(true).margin({
            top: 0
        }).direction(app.lang.direction).tooltipContent(function(key, x, y, e, graph) {
            // Oli
            var val = app.currency.formatAmountLocale(y, app.currency.getBaseCurrencyId());
            if (val.substr(0, 1) == '\u20AC') {
                val = val.substr(1, val.length-1) + val.substr(0, 1);
            }
            //var val = app.currency.formatAmountLocale(y, app.currency.getBaseCurrencyId());
            var salesStageLabels = app.lang.getAppListStrings('sales_stage_dom');
            return '<p>' + DOTB.App.lang.get('LBL_SALES_STAGE', 'Forecasts') + ': <b>' + ((salesStageLabels && salesStageLabels[key]) ? salesStageLabels[key] : key) + '</b></p>' + '<p>' + DOTB.App.lang.get('LBL_AMOUNT', 'Forecasts') + ': <b>' + val + '</b></p>' + '<p>' + DOTB.App.lang.get('LBL_PERCENT', 'Forecasts') + ': <b>' + x + '%</b></p>';
        }).colorData('class', {
            step: 2
        }).fmtValueLabel(function(d) {
            var y = d.label || d;
            // Oli
            var v = app.currency.formatAmountLocale(y, app.currency.getBaseCurrencyId()).replace(/\,00$|\.00$/, '');
            if (v.substr(0, 1) == '\u20AC') {
                v = v.substr(1, v.length-1) + v.substr(0, 1);
            }
            return v;
        }).strings({
            legend: {
                close: app.lang.get('LBL_CHART_LEGEND_CLOSE'),
                open: app.lang.get('LBL_CHART_LEGEND_OPEN')
            },
            noData: app.lang.get('LBL_CHART_NO_DATA')
        });
    },
    _initPlugins: function() {
        if (this.isManager) {
            this.plugins = _.union(this.plugins, ['ToggleVisibility']);
        }
        return this;
    },
    bindDataChange: function() {
        this.settings.on('change', function(model) {
            if (this.$el && this.$el.is(':visible')) {
                this.loadData({});
            }
        }, this);
    },
    renderChart: function() {
        if (!this.isChartReady()) {
            return;
        }
        this.$('svg#' + this.cid).children().remove();
        d3.select('svg#' + this.cid).datum(this.results).transition().duration(500).call(this.chart);
        this.chart_loaded = _.isFunction(this.chart.update);
        this.displayNoData(!this.chart_loaded);
    },
    hasChartData: function() {
        return !_.isEmpty(this.results) && this.results.data && this.results.data.length > 0;
    },
    loadData: function(options) {
        var timeperiod = this.settings.get('selectedTimePeriod');
        if (timeperiod) {
            var forecastBy = app.metadata.getModule('Forecasts', 'config').forecast_by || 'Opportunities',
                url_base = forecastBy + '/chart/pipeline/' + timeperiod + '/';
            if (this.isManager) {
                // fixed Donuc & Oli 2016-02-18
                //url_base += '/' + this.getVisibility();
                url_base += this.getVisibility();
            }
            var url = app.api.buildURL(url_base);
            app.api.call('GET', url, null, {
                success: _.bind(function(o) {
                    if (o && o.data) {
                        var salesStageLabels = app.lang.getAppListStrings('sales_stage_dom');
                        _.each(o.data, function(dataBlock) {
                            if (dataBlock && dataBlock.key && salesStageLabels && salesStageLabels[dataBlock.key]) {
                                dataBlock.key = salesStageLabels[dataBlock.key];
                            }
                        });
                    }
                    this.results = {};
                    this.results = o;
                    this.renderChart();
                }, this),
                error: _.bind(function(o) {
                    this.results = {};
                    this.renderChart();
                }, this),
                complete: options ? options.complete : null
            });
        }
    },
    unbind: function() {
        this.settings.off('change');
        this._super('unbind');
    }
})