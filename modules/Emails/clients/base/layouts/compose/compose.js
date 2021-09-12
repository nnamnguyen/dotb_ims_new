
/**
 * @class View.Layouts.Base.Emails.ComposeLayout
 * @alias DOTB.App.view.layouts.BaseEmailsComposeLayout
 * @extends View.Layouts.Base.Emails.CreateLayout
 * @deprecated Use {@link View.Layouts.Base.Emails.ComposeEmailLayout} instead.
 */
({
    extendsFrom: 'EmailsCreateLayout',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        app.logger.warn('View.Layouts.Base.Emails.ComposeLayout is deprecated. ' +
            'Use View.Layouts.Base.Emails.ComposeEmailLayout instead.');

        this._super('initialize', [options]);
    }
})
