
/**
 * @class View.Layouts.Base.Emails.ComposeEmailLayout
 * @alias DOTB.App.view.layouts.BaseEmailsComposeEmailLayout
 * @extends View.Layouts.Base.Emails.CreateLayout
 */
({
    extendsFrom: 'EmailsCreateLayout',

    /**
     * @inheritdoc
     *
     * Enables the Compose:Send shortcut for views that implement it.
     */
    initialize: function(options) {
        this.shortcuts = _.union(this.shortcuts || [], ['Compose:Send']);
        this._super('initialize', [options]);
    }
})
