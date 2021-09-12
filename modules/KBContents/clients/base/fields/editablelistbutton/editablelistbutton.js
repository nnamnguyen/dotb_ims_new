
/**
 * @class View.Fields.KBContents.EditablelistbuttonField
 * @alias DOTB.App.view.fields.KBContentsEditablelistbuttonField
 * @extends View.Fields.Base.EditablelistbuttonField
 */
({
    extendsFrom: 'EditablelistbuttonField',

    /**
     * @inheritdoc
     *
     * Add KBNotify plugin for field.
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], [
            'KBNotify'
        ]);
        this._super('initialize', [options]);
    },

    /**
     * Overriding custom save options to trigger kb:collection:updated event when KB model saved.
     *
     * @override
     * @param {Object} options
     */
    getCustomSaveOptions: function(options) {
        var success = _.compose(options.success, _.bind(function(model) {
            this.notifyAll('kb:collection:updated', model);
            return model;
        }, this));
        return {'success': success};
    }
})
