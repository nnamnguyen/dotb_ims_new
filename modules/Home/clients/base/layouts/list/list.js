
/**
 * @class View.Layouts.Home.ListLayout
 * @alias DOTB.App.view.layouts.HomeListLayout
 * @extends View.DashboardLayout
 * @deprecated 7.9.0 Will be removed in 7.11.0. Use
 *   {@link View.Layouts.Home.Record} instead.
 */
({
    extendsFrom: 'DashboardLayout',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        app.logger.warn('View.Layouts.Home.ListLayout has been deprecated since 7.9.0.0. ' +
        'It will be removed in 7.11.0.0. Please use View.Layouts.Home.Record instead.');
        this._super('initialize', [options]);
    }
})

