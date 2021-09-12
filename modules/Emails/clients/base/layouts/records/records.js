
/**
 * @class View.Layouts.Base.Emails.RecordsLayout
 * @alias DOTB.App.view.layouts.BaseEmailsRecordsLayout
 * @extends View.Layouts.Base.RecordsLayout
 */
({
    extendsFrom: 'RecordsLayout',

    /**
     * @inheritdoc
     *
     * Remove shortcuts that do not apply to Emails module list view
     */
    initialize: function(options) {
        this.shortcuts = _.without(
            this.shortcuts,
            'List:Favorite',
            'List:Follow'
        );

        this._super('initialize', [options]);
    }
})
