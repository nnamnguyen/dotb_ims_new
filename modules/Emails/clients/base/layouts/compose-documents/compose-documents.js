
/**
 * @class View.Layouts.Base.Emails.ComposeDocumentsLayout
 * @alias DOTB.App.view.layouts.BaseEmailsComposeDocumentsLayout
 * @extends View.Layout
 * @deprecated Use {@link View.Layouts.Base.SelectionListLayout} instead.
 */
({
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        app.logger.warn('View.Layouts.Base.Emails.ComposeDocumentsLayout is deprecated.');

        this._super('initialize', [options]);
    }
})
