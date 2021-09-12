/**
 * @class App.view.views.BaseDriCustomerJourneyDashletView
 * @extends View.View
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
({
    plugins: ['Dashlet', 'Chart', 'CssLoader'],

    css: [ 'custom/clients/base/views/dri-workflow/dri-workflow.css' ],

    className: "customer-journey-chart-wrapper",
    loaded: false,
    data: null,
    selected: null,

    tplErrorMap: {
        ERROR_INVALID_LICENSE: 'invalid-license'
    },

    colors: {
        completed: "#33800d",
        not_completed: "#e5a117",
        in_progress: "#176de5",
        not_started: "#cccccc"
    },

    /**
     * {@inheritdoc}
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        this.setShowChartLabels = _.bind(this.setShowChartLabels, this);

        this.model.on("customer_journey_widget_reloading", this.loadData, this);
        this.model.on("customer_journey:active-cycle:click", this.setActiveCycle, this);

        this.layout.on('dashlet:collapse', this.renderChart, this);

        this.chart = nv.models.pieChart()
            .x(function (d) { return d.key; })
            .y(function (d) { return d.value; })
            .margin({top: 0, right: 0, bottom: 0, left: 0})
            .donut(true)
            .donutLabelsOutside(true)
            .donutRatio(0.35)
            .hole(this.total)
            .showTitle(false)
            .tooltips(true)
            .showLegend(false)
            .colorData('data')
            //.direction(app.lang.direction)
            .color(function(d){
                return d.data.color
            })
            .tooltipContent(function (key, x, y, e, graph) {
                return '<p><b>' + key + '</b></p>';
            })
            .strings({
                noData: app.lang.get('LBL_CHART_NO_DATA')
            });

        this.setShowChartLabels();
    },

    /**
     * @param {string} id
     */
    setActiveCycle: function (id) {
        if (!id || this.selected != id) {
            this.selected = id;
            this.loadData();
        }
    },

    /**
     * {@inheritdoc}
     */
    delegateEvents: function () {
        this._super("delegateEvents");
        $(window).on("resize", this.setShowChartLabels);
    },

    /**
     * {@inheritdoc}
     */
    unbind: function () {
        this._super("unbind");
        $(window).off("resize", this.setShowChartLabels);

        if (this.layout) {
            this.layout.off(null, null, this);
        }

        if (this.model) {
            this.model.off(null, null, this);
        }
    },

    /**
     * Toggles the chart labels
     */
    setShowChartLabels: function () {
        if (this.chart) {
            var large = $(".dashboard").width() > 460;
            this.chart.showLabels(large);
        }
    },

    /**
     * Renders the chart
     */
    renderChart: function() {
        if (!this.isChartReady()) {
            return;
        }

        // Set value of label inside donut chart
        this.chart.hole(Math.floor(this.total * 100) + "%");

        d3.select('svg#' + this.cid)
            .datum(this.chartCollection)
            .transition().duration(500)
            .call(this.chart);

        this.chart_loaded = _.isFunction(this.chart.update);
        this.displayNoData(!this.chart_loaded);
        this.setShowChartLabels();
    },

    /**
     * {@inheritdoc}
     */
    loadData: function (options) {
        var self = this, url;

        if (this.meta.config) {
            return;
        }

        this.loaded = false;
        this.data = null;

        if (this.$el) {
            this.$el.children().fadeTo("slow", 0.7);
        }

        url = app.api.buildURL(this.model.module, 'customer-journey/chart-data', {
            id: this.model.get('id')
        }, {
            selected: this.selected
        });

        app.api.call('read', url, null, {
            success: _.bind(this.loadCompleted, this),
            error: _.bind(this.loadError, this),
            complete: options ? options.complete : null
        });
    },

    /**
     * @returns {boolean}
     */
    hasChartData: function () {
        return !!this.data;
    },

    /**
     * @param {object} data
     */
    loadCompleted: function (data) {
        this.loaded = true;
        this.error = "";
        this.template = app.template.get(this.name);
        this.evaluateResult(data);
        if (!this.disposed) {
            this.render();
        }
    },

    /**
     * @param {object} error
     */
    loadError: function (error) {
        this.loaded = true;

        if (this.disposed) {
            return;
        }

        this.$el.children().fadeTo("slow", 1);

        var tpl = this.tplErrorMap[error.message] || 'error';
        this.error = error;
        this.template = app.template.get(this.name + '.' + tpl);
        this.render();
    },

    /**
     * {@inheritdoc}
     */
    render: function () {
        if (this.$el) {
            this.$el.children().fadeTo("slow", 1);
        }

        this._super('render');

        if (!this.meta.config) {
            if (this.loaded) {
                var collapsed = !this.data || this.data.state === "completed";
                this.layout.collapse(collapsed);
                this.layout.trigger('dashlet:collapse', collapsed);
                this.displayNoData(!this.data);
            } else {
                this.displayNoData(true);
            }
        }
    },

    /**
     * Processes the chart data
     *
     * @param data
     */
    evaluateResult: function (data) {
        if (!data) {
            return;
        }

        this.total = data.progress;
        this.data = data;
        this.selected = data.id;

        this.chartCollection = {
            data: [],
            properties: {
                title: data.name,
                value: 3,
                label: data.stages.length
            }
        };

        _.each(data.stages, function (stage) {
            this.chartCollection.data.push({
                key: stage.label,
                label: stage.label,
                classes: stage.state,
                value: 1,
                color : this.colors[stage.state]
            });
        }, this);
    }
})
