
/**
 * Rowaction is a button that when selected will trigger a Backbone Event.
 *
 * @class View.Fields.KBContents.RowactionField
 * @alias DOTB.App.view.fields.KBContentsRowactionField
 * @extends View.Fields.Base.RowactionField
 */
({
    extendsFrom: 'RowactionField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        if ((this.options.def.name === 'create_localization_button' ||
            this.options.def.name === 'create_revision_button') && !app.acl.hasAccessToModel('view', this.model)) {
            this.hide();
        }
    }
})
