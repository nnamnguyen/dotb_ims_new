
/**
 * @class View.Fields.Base.ProductBundles.QuoteFooterInputField
 * @alias DOTB.App.view.fields.BaseProductBundlesQuoteFooterInputField
 * @extends View.Fields.Base.Field
 */
({
    /**
     * The value dollar amount
     */
    value_amount: undefined,

    /**
     * The value percent amount
     */
    value_percent: undefined,

    /**
     * @inheritdoc
     */
    format: function(value) {
        if (!value) {
            this.value_amount = app.currency.formatAmountLocale('0');
            this.value_percent = '0%';
        }
    }
})
