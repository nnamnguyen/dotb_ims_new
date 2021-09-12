
/**
 * @class View.Fields.Base.RevenueLineItems.CurrencyField
 * @alias DOTB.App.view.fields.BaseRevenueLineItemsCurrencyField
 * @extends View.Fields.Base.CurrencyField
 */
({
    extendsFrom: 'BaseCurrencyField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        // Enabling currency dropdown on RLIl ist views
        this.hideCurrencyDropdown = false;
    }
})
