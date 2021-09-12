
/**
 * @class View.Layouts.Base.Emails.ArchiveEmailLayout
 * @alias DOTB.App.view.layouts.BaseEmailsArchiveEmailLayout
 * @extends View.Layouts.Base.Emails.CreateLayout
 * @deprecated Use {@link View.Layouts.Base.Emails.CreateLayout} instead.
 */
({
    extendsFrom: 'EmailsCreateLayout',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        app.logger.warn('View.Layouts.Base.Emails.ArchiveEmailLayout is deprecated. ' +
            'Use View.Layouts.Base.Emails.CreateLayout instead.');

        this._super('initialize', [options]);
    }
})
