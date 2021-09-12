
/**
 * @class View.Fields.Base.KBContents.StickyRowactionField
 * @alias DOTB.App.view.fields.BaseKBContentsStickyRowactionField
 * @extends View.Fields.Base.StickyRowactionField
 */
({
    extendsFrom: 'StickyRowactionField',

    /**
     * Disable field if it has no access to edit.
     * @inheritdoc
     */
    isDisabled: function() {
        var parentLayout = this.context.parent.get('layout');
        var parentModel = this.context.parent.get('model');

        if (
            this.def.name === 'create_button' &&
            parentLayout === 'record' &&
            !app.acl.hasAccessToModel('edit', parentModel)
        ) {
            return true;
        }
        return this._super('isDisabled');
    }

})
