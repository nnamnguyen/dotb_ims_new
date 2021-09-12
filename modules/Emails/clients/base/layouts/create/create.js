
/**
 * @class View.Layouts.Base.Emails.CreateLayout
 * @alias DOTB.App.view.layouts.BaseEmailsCreateLayout
 * @extends View.Layouts.Base.CreateLayout
 */
({
    extendsFrom: 'CreateLayout',

    /**
     * @inheritdoc
     *
     * Enables the DragdropSelect2:SelectAll shortcut for views that implement
     * it.
     */
    initialize: function(options) {
        this.shortcuts = _.union(this.shortcuts || [], ['DragdropSelect2:SelectAll']);
        this._super('initialize', [options]);
    }
})
