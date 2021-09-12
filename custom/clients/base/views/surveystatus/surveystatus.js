/**
 * The file used to set custom dashlet for Survey Status Report
 *
 * LICENSE: The contents of this file are subject to the license agreement ("License") which is included
 * in the installation package (LICENSE.txt). By installing or using this file, you have unconditionally
 * agreed to the terms and conditions of the License, and you may not use this file except in compliance
 * with the License.
 *
 * @author     Biztech Consultancy
 */
/**
 * @class View.Views.Base.SurveystatusView
 * @alias DOTB.App.view.views.BaseSurveystatusView
 * @extends View.View
 */
({
    events: {
        'shown.bs.tab a[data-toggle="tab"]': 'resize',
        'click a[name=editReport]': 'editSavedReport'
    },

    plugins: ['Dashlet', 'Chart'],
    className: 'survey-status-wrapper',

    tabData: null,
    tabClass: '',
    surveyId: '',

    /**
     * @inheritdoc
     */
    initDashlet: function (view) {
        if (this.meta.config) {
            this.meta.panels = this.dashletConfig.dashlet_config_panels;
        } else {
            var autoRefresh = this.settings.get('auto_refresh');
            if (autoRefresh > 0) {
                if (this.timerId) {
                    clearTimeout(this.timerId);
                }

                this._scheduleReload(autoRefresh * 1000 * 60);
            }
        }
        this.meta.label = 'Survey Status Report';
        // Call Quick Status Report in Dashlet
        app.events.on('view_quick_status_report:render', this.loadData, this);
    },

    /**
     * Schedules chart data reload
     *
     * @param {Number} delay Number of milliseconds which the reload should be delayed for
     * @private
     */
    _scheduleReload: function (delay) {
        this.timerId = setTimeout(_.bind(function () {
            this.context.resetLoadFlag();
            this.loadData({
                success: function () {
                    this._scheduleReload(delay);
                }
            });
        }, this), delay);
    },

    /**
     * @inheritdoc
     */
    bindDataChange: function () {
        var self = this;
        if (this.meta.config) {
            this.settings.on('change:saved_report_id', function (model) {
                var reportId = model.get('saved_report_id');
                var options;
                if (_.isEmpty(reportId)) {
                    return;
                }

                //this.meta.label = model.get('saved_report') + ' : Status Report';

                options = {
                    success: function (data) {
                        var label;
                        label = $('[name="label"]');
                        if (label.length) {
                            label.val('Survey Status Report');
                        }
                    }
                };

                self.loadTitle(options);

            }, this);
        }
    },

    /**
     * @inheritdoc
     */
    initialize: function (options) {
        this._super('initialize', [options]);

        this.surveyId = options.meta.saved_report_id;

        this.tooltipTemplate = app.template.getField('chart', 'singletooltiptemplate', this.module);
        this.locale = DOTB.charts.getSystemLocale();

        this.chart = sucrose.charts.pieChart()

                .margin({top: 0, right: 0, bottom: 0, left: 0})
                .donut(true)
                .donutLabelsOutside(true)
                .donutRatio(0.447)
                .rotateDegrees(0)
                .arcDegrees(360)
                .maxRadius(110)
                .hole(this.total)
                .showTitle(true)
                .tooltips(true)
                .showLegend(true)
                .direction(app.lang.direction)
                .colorData('data')
                .tooltipContent(_.bind(function (eo, properties) {
                    var point = {};
                    point.key = this.chart.getKey()(eo);
                    point.label = app.lang.get('LBL_CHART_COUNT');
                    point.value = this.chart.getValue()(eo);
                    point.percent = sucrose.utility.numberFormatPercent(point.value, properties.total, this.locality);
                    return this.tooltipTemplate(point).replace(/(\r\n|\n|\r)/gm, '');
                }, this))
                .strings({
                    noData: app.lang.get('LBL_CHART_NO_DATA'),
                    noLabel: app.lang.get('LBL_CHART_NO_LABEL')
                })
                .locality(this.locale);
        options.context.set("currentFilterId", "survey-records");
        this.locality = this.chart.locality();
    },

    /**
     * Generic method to render chart with check for visibility and data.
     * Called by _renderHtml and loadData.
     */
    renderChart: function () {
        if (!this.isChartReady()) {
            return;
        }

        // Set value of label inside donut chart
        this.chart.hole(this.total);
        d3dotb.select(this.el).select('svg#' + this.cid)
                .datum(this.chartCollection)
                .transition().duration(500)
                .call(this.chart);

        this.chart_loaded = _.isFunction(this.chart.update);
//        this.displayNoData(!this.chart_loaded);
    },

    /**
     * Build content with favorite fields for content tabs
     */
    addFavs: function () {
        var self = this;
        //loop over metricsCollection
        _.each(this.tabData, function (tabGroup) {
            if (tabGroup.models && tabGroup.models.length > 0) {
                _.each(tabGroup.models, function (model) {
                    var field = app.view.createField({
                        def: {type: 'favorite'},
                        model: model,
                        meta: {view: 'detail'},
                        viewName: 'detail',
                        view: self
                    });
                    field.setElement(self.$('[data-model-id="' + model.id + '"]'));
                    field.render();
                });
            }
        });
    },

    /* Process data loaded from REST endpoint so that d3 chart can consume
     * and set general chart properties
     */
    evaluateResult: function (callDataStatusReport) {

        callDataStatusReport = JSON.parse(callDataStatusReport);
        this.total = callDataStatusReport['total'];

        this.chartCollection = {
            data: [],
            properties: {
                title: this.meta.saved_report + ' : Status Report',
                value: 3,
                label: this.total
            }
        };
        this.chartCollection.data.push({
            key: callDataStatusReport['chart']['data'][0]['label'],
            value: callDataStatusReport['chart']['data'][0]['value'],
            color: callDataStatusReport['chart']['data'][0]['color']
        });
        this.chartCollection.data.push({
            key: callDataStatusReport['chart']['data'][1]['label'],
            value: callDataStatusReport['chart']['data'][1]['value'],
            color: callDataStatusReport['chart']['data'][1]['color']
        });
        this.chartCollection.data.push({
            key: callDataStatusReport['chart']['data'][2]['label'],
            value: callDataStatusReport['chart']['data'][2]['value'],
            color: callDataStatusReport['chart']['data'][2]['color']
        });

        if (!_.isEmpty(callDataStatusReport)) {
            this.processSurveyStatus(callDataStatusReport);
        }

    },

    /**
     * Build tab related data and set tab class name based on number of tabs
     * @param {data} object The chart related data.
     */
    processSurveyStatus: function (data) {
        this.tabData = [];

        var status2css = {
        },
                stati = {"0": "Submitted", "1": "Not Viewed", "2": "Viewed"},
                statusOptions = {"Submitted": "Submitted", "Not Viewed": "Not Viewed", "Viewed": "Viewed"};

        _.each(stati, function (status, index) {
            if (!status2css[status]) {
                this.tabData.push({
                    index: index,
                    status: status,
                    statusLabel: statusOptions[status],
                    models: data['chart']['data'][index]['value'],
                    cssStyle: data['chart']['data'][index]['color']
                });
            }
        }, this);

        this.tabClass = 'three';
    },

    loadTitle: function (options) {
        var self = this;
        var url = App.api.buildURL("bc_survey", "dashlet_survey_status_chart", "", {survey_id: self.surveyId});

        app.api.call('create', url, null, {
            success: _.bind(function (callDataStatusReport) {
                self.evaluateResult(callDataStatusReport);

                if (!self.disposed) {
                    // we have to rerender the entire dashlet, not just the chart,
                    // because the HBS file is dependant on processCases completion
                    self.render();
                    self.addFavs();
                }
            }),
            error: _.bind(function () {
//                this.displayNoData(true);
            }, this),
            complete: options ? options.success : null,
            limit: -1,
        });
    },
    /**
     * @inheritdoc
     */
    loadData: function (options) {
        var self = this;
//        if (this.meta.config) {
//            return;
//        }
        var surveyID = '';
        var self = this;
        var url = App.api.buildURL("bc_survey", "dashlet_survey_status_chart", "", {survey_id: self.surveyId});

        app.api.call('create', url, null, {
            success: _.bind(function (callDataStatusReport) {
                self.evaluateResult(callDataStatusReport);

                callDataStatusReport = JSON.parse(callDataStatusReport);

                if (callDataStatusReport['chart']['data'][0]['value'] == 0 && callDataStatusReport['chart']['data'][1]['value'] == 0 && callDataStatusReport['chart']['data'][2]['value'] == 0)
                {
//                    this.displayNoData(true);
                } else if (!self.disposed) {
                    // we have to rerender the entire dashlet, not just the chart,
                    // because the HBS file is dependant on processCases completion
                    self.render();
                    self.addFavs();
                }
            }),
            error: _.bind(function () {
//                this.displayNoData(true);
            }, this),
            complete: options ? options.success : null,
            limit: -1,
        });

    },
})
