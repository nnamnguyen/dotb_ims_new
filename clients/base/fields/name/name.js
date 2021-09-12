
/**
 * @class View.Fields.Base.NameField
 * @alias DOTB.App.view.fields.BaseNameField
 * @extends View.Fields.Base.BaseField
 */
({
    plugins: ['MetadataEventDriven'],

    _render: function() {
        // FIXME: This will be cleaned up by SC-3478.
        if (this.view.name === 'audit') {
            this.def.link = false;
        } else if (this.view.name === 'preview') {
            this.def.link = _.isUndefined(this.def.link) ? true : this.def.link;
            this.def.events = false;
        }
        this._super('_render');
    }
})
