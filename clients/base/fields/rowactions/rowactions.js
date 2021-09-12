
/**
 * @class View.Fields.Base.RowactionsField
 * @alias DOTB.App.view.fields.BaseRowactionsField
 * @extends View.Fields.Base.ActiondropdownField
 */
({
    extendsFrom: 'ActiondropdownField',

    /**
     * @inheritdoc
     */
    _render: function() {
        this._super('_render');

        //FIXME: SC-3372 Actions should not be based on `this.view.action`

        // check to see if this is a create subpanel
        var isCreate = this.context.get('isCreateSubpanel') || false,
            shouldHide = (this.view.action === 'list' && this.action === 'edit');
        // if this is a create subpanel, trump other logic as rowactions needs to be shown on edit
        if (isCreate || !shouldHide) {
            this.show();
        } else {
            this.hide();
        }
    }
})
