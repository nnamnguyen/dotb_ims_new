
/**
 * @class View.Fields.Base.Products.TextareaField
 * @alias DOTB.App.view.fields.BaseProductsTextareaField
 * @extends View.Fields.Base.BaseTextareaField
 */
({
    extendsFrom: 'BaseTextareaField',
    /**
     * Making the textarea editable for the Quotes Line items
     * @inheritdoc
     */
    setMode: function(name) {
        if (this.view.name === 'quote-data-group-list' && this.tplName === 'list') {
            app.view.Field.prototype.setMode.call(this, name);
        } else {
            this._super('setMode', [name]);
        }
    }
})
