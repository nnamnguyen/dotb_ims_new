
/**
 * @class View.Layouts.Home.RecordsLayout
 * @alias DOTB.App.view.layouts.HomeRecordsLayout
 * @extends View.Layout
 * @deprecated 7.9.0 Will be removed in 7.11.0. Use
 *   {@link View.Layouts.Home.Record} instead.
 */
({
    /**
     * @inheritdoc
     */
    initialize: function(options) {

        app.logger.warn('View.Layouts.Home.RecordsLayout has been deprecated since 7.9.0.0. ' +
        'It will be removed in 7.11.0.0. Please use View.Layouts.Home.Record instead.');
        this._super('initialize', [options]);
    }
})
