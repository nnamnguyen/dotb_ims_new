
/**
 * @class View.Fields.Base.ProductBundles.QuoteDataActiondropdownField
 * @alias DOTB.App.view.fields.BaseProductBundlesQuoteDataActiondropdownField
 * @extends View.Fields.Base.ActiondropdownField
 */
({
    /**
     * @inheritdoc
     */
    extendsFrom: 'BaseActiondropdownField',

    /**
     * @inheritdoc
     */
    className: 'quote-data-actiondropdown',

    /**
     * Skipping ActionmenuField's override, just returning this.def.buttons
     *
     * @inheritdoc
     */
    _getChildFieldsMeta: function() {
        return app.utils.deepCopy(this.def.buttons);
    },

    /**
     * Overriding for quote-data-group-header in create view to display a specific template
     *
     * @inheritdoc
     */
    _loadTemplate: function() {
        this._super('_loadTemplate');

        if (this.view.name === 'quote-data-group-header' && this.view.isCreateView) {
            this.template = app.template.getField('quote-data-actiondropdown', 'list', this.model.module);
        }
    }
})
