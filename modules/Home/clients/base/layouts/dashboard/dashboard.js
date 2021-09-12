
/**
 * @class View.Layouts.Home.DashboardLayout
 * @alias DOTB.App.view.layouts.HomeDashboardLayout
 * @extends View.Layouts.DashboardLayout
 * @deprecated 7.9.0 Will be removed in 7.11.0. Use
 *   {@link View.Layouts.Dashboards.DashboardLayout} instead.
 */
({
    extendsFrom: 'DashboardLayout',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        app.logger.warn('View.Layouts.Home.DashboardLayout has been deprecated since 7.9.0.0. ' +
        'It will be removed in 7.11.0.0. Please use View.Layouts.Dashboards.DashboardLayout instead.');
        this._super('initialize', [options]);
    }
})
