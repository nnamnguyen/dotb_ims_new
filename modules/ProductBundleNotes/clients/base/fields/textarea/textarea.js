
/**
 * @class View.Fields.Base.ProductBundleNotes.TextareaField
 * @alias DOTB.App.view.fields.BaseProductBundleNotesTextareaField
 * @extends View.Fields.Base.BaseTextareaField
 */
({
    extendsFrom: 'BaseTextareaField',

    /**
     * Having to override because we do want it to go to edit in the list
     * contrary to everywhere else in the app
     *
     * @inheritdoc
     */
    setMode: function(name) {
        // skip textarea's setMode and call straight to Field.setMode
        app.view.Field.prototype.setMode.call(this, name);
    }
});
