
/**
 * @class View.Fields.Base.Audit.CurrencyField
 * @alias DOTB.App.view.fields.BaseAuditCurrencyField
 * @extends View.Fields.Base.CurrencyField
 */
({
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        //audit log is always in base currency. Make sure the currency def reflects that.
        this.def.is_base_currency = true;
    }
})
