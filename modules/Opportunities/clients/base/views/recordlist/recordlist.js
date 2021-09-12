
/**
 * @class View.Views.Base.OpportunitiesRecordlistView
 * @alias DOTB.App.view.views.BaseOpportunitiesRecordlistView
 * @extends View.Views.Base.RecordlistView
 */
({
    extendsFrom: 'RecordlistView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['CommittedDeleteWarning']);
        this._super("initialize", [options]);
    },

    /**
     * @inheritdoc
     */
    parseFieldMetadata: function(options) {
        options = this._super('parseFieldMetadata', [options]);

        app.utils.hideForecastCommitStageField(options.meta.panels);

        return options;
    }
})
