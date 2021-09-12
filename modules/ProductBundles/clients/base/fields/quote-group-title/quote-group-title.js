
/**
 * @class View.Fields.Base.ProductBundles.QuoteGroupTitleField
 * @alias DOTB.App.view.fields.BaseProductBundlesQuoteGroupTitleField
 * @extends View.Fields.Base.Field
 */
({
    /**
     * Any additional CSS classes that need to be applied to the field
     */
    css_class: undefined,

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.css_class = options.def.css_class || '';
        this._super('initialize', [options]);
    }
})
