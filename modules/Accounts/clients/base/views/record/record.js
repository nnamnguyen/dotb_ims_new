
/**
 * @class View.Views.Base.Accounts.RecordView
 * @alias DOTB.App.view.views.BaseAccountsRecordView
 * @extends View.Views.Base.RecordView
 */
({
    extendsFrom: 'RecordView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['HistoricalSummary']);
        this._super('initialize', [options]);
    }
})
