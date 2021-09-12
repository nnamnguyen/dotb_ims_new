
/**
 * @class View.Fields.Base.Products.QuoteDataActionmenuField
 * @alias DOTB.App.view.fields.BaseProductsQuoteDataActionmenuField
 * @extends View.Fields.Base.ActionmenuField
 */
({
    /**
     * @inheritdoc
     */
    extendsFrom: 'BaseActionmenuField',

    /**
     * Skipping ActionmenuField's override, just returning this.def.buttons
     *
     * @inheritdoc
     */
    _getChildFieldsMeta: function() {
        return app.utils.deepCopy(this.def.buttons);
    },

    /**
     * Triggers massCollection events to the context.parent
     *
     * @inheritdoc
     */
    toggleSelect: function(checked) {
        var event = !!checked ? 'mass_collection:add' : 'mass_collection:remove';
        this.model.selected = !!checked;
        this.context.parent.trigger(event, this.model);
    }
})
