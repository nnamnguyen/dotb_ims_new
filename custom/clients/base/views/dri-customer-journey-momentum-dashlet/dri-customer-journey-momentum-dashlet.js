/**
 * @class App.view.views.BaseDriCustomerJourneyDashletView
 * @extends View.View
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
({
    plugins: ['Dashlet', 'Chart', 'CssLoader'],

    loaded: false,
    data: null,
    selected: null,

    tplErrorMap: {
        ERROR_INVALID_LICENSE: 'invalid-license'
    },

    /**
     * {@inheritdoc}
     */
    initialize: function (options) {
        this._super('initialize', [options]);

        this.model.on("customer_journey_widget_reloading", this.loadData, this);
        this.model.on("customer_journey:active-cycle:click", this.setActiveCycle, this);

        this.layout.on('dashlet:collapse', this.renderChart, this);

        this.chart = nv.models.gaugeChart()
            .showLabels(false)
            .showTitle(true)
            .tooltips(false)
            .showPointer(true)
            .showLegend(false)
            .colorData('data')
            .ringWidth(50)
            .direction('ltr')
            .maxValue(100)
            .transitionMs(4000);
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
    unbind: function () {
        this._super("unbind");

        if (this.layout) {
            this.layout.off(null, null, this);
        }

        if (this.model) {
            this.model.off(null, null, this);
        }
    },

    /**
     * Renders the chart
     */
    renderChart: function () {
        if (!this.isChartReady()) {
            return;
        }

        d3.select('svg#' + this.cid)
            .datum(this.chartCollection)
            .transition().duration(500)
            .call(this.chart);

        this.chart_loaded = _.isFunction(this.chart.update);

        this.displayNoData(!this.chart_loaded);
        count = 0;
        path = $('.nv-arc-path');
        var self = this;
        _.each(path, function (elem) {

            $(elem).css('fill', self.data.data[count].color)
            count++;
        });
        point = this.data.ratio;
        degree = point * 1.8 - 90;
        $('.nv-pointer path').attr('transform','rotate('+ degree +')');

    },

    /**
     * {@inheritdoc}
     */
    loadData: function (options) {
        if (this.meta.config) {
            return;
        }

        this.loaded = false;
        this.data = null;

        if (this.$el) {
            this.$el.children().fadeTo("slow", 0.7);
        }

        var url = app.api.buildURL(this.model.module, 'customer-journey/momentum-chart', {
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

        this.total = data.ratio;
        this.data = data;
        this.selected = data.id;

        this.chartCollection = {
            data: data.data,
            properties: {
                title: data.name,
                value: data.ratio,
                values: data.values,
                colorLength: data.data.length
            }
        };
    }
})
