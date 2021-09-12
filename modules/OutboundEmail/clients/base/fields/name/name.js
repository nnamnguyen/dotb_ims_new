
/**
 * @class View.Fields.Base.OutboundEmail.NameField
 * @alias DOTB.App.view.fields.BaseOutboundEmailNameField
 * @extends View.Fields.Base.NameField
 */
({
    extendsFrom: 'BaseNameField',

    /**
     * Adds help text (LBL_SYSTEM_ACCOUNT) for the system account. Be aware
     * that this will replace any help text that is defined in metadata.
     *
     * @inheritdoc
     */
    _render: function() {
        if (this.model.get('type') === 'system') {
            this.def.help = 'LBL_SYSTEM_ACCOUNT';
        }

        return this._super('_render');
    }
})
