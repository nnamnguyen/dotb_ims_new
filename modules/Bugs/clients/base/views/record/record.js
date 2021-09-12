
/**
 * @class View.Views.Base.Bugs.RecordView
 * @alias DOTB.App.view.views.BaseBugsRecordView
 * @extends View.Views.Base.RecordView
 */
({
    extendsFrom: 'RecordView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['HistoricalSummary', 'KBContent']);
        this._super('initialize', [options]);
    }
})
