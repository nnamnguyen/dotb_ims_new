
({
    extendsFrom: 'SalesPipelineView',

    /**
     * Is the forecast Module setup??
     */
    forecastSetup: 0,

    /**
     * Holds the forecast isn't set up message if Forecasts hasn't been set up yet
     */
    forecastsNotSetUpMsg: undefined,

    /**
     * Track if current user is manager.
     */
    isManager: false,

    /**
     * @inheritDoc
     */
    initialize: function(options) {
        options.meta.type = 'sales-pipeline';
        options.meta = _.extend({}, app.metadata.getView(this.module, 'sales-pipeline'), options.meta);

        this._super('initialize', [options]);
    }
})
