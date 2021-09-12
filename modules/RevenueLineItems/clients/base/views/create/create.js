
/**
 * @class View.Views.Base.RevenueLineItems.CreateView
 * @alias DOTB.App.view.views.RevenueLineItemsCreateView
 * @extends View.Views.Base.CreateView
 */
({
    extendsFrom: 'CreateView',

    initialize: function(options) {
        this._super('initialize', [options]);
        app.utils.hideForecastCommitStageField(this.meta.panels);
    }
})
