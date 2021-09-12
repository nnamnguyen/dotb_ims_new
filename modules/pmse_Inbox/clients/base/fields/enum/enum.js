
/**
 * @class View.Fields.Base.pmse_Inbox.EnumField
 * @alias DOTB.App.view.fields.Basepmse_InboxEnumField
 * @extends View.Fields.Base.EnumField
 */
({
    extendsFrom: 'EnumField',

    /**
     * @inheritdoc
     */
    _render: function() {
        this.items = this.model.get('cas_reassign_user_combo_box');
        this._super('_render');
    }
})
