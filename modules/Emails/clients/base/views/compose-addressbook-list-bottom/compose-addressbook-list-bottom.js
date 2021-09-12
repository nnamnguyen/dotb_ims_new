
/**
 * @class View.Views.Base.Emails.ComposeAddressbookListBottomView
 * @alias DOTB.App.view.views.BaseEmailsComposeAddressbookListBottomView
 * @extends View.Views.Base.ListBottomView
 */
({
    extendsFrom: 'ListBottomView',

    /**
     * Assign proper label for 'show more' link.
     * Label should be "More recipients...".
     */
    setShowMoreLabel: function() {
        this.showMoreLabel = app.lang.get('LBL_SHOW_MORE_RECIPIENTS', this.module);
    }
})
