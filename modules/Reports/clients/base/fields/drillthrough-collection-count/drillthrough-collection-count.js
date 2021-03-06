
/**
 * DrillthroughCollectionCountField is a field for Reports to set total in drillthrough drawer headerpane.
 *
 * @class View.Fields.Base.Reports.DrillthroughCollectionCountField
 * @alias DOTB.App.view.fields.BaseReportsDrillthroughCollectionCountField
 * @extends View.Fields.Base.CollectionCountField
 */
({
    extendsFrom: 'CollectionCountField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.type = 'collection-count';
    },

    /**
     * @inheritdoc
     *
     * Calls ReportsApi to get collection count.
     */
    fetchCount: function() {
        if (_.isNull(this.collection.total)) {
            app.alert.show('fetch_count', {
                level: 'process',
                title: app.lang.get('LBL_LOADING'),
                autoClose: false
            });
        }
        var filterDef = this.context.get('filterDef');
        var useSavedFilters = this.context.get('useSavedFilters') || false;
        var params = {group_filters: filterDef, use_saved_filters: useSavedFilters};
        var reportId = this.context.get('reportId');
        var url = app.api.buildURL('Reports', 'record_count', {id: reportId}, params);
        app.api.call('read', url, null, {
            success: _.bind(function(data) {
                this.collection.total = parseInt(data.record_count, 10);
                if (!this.disposed) {
                    this.updateCount();
                }
            }, this),
            complete: function() {
                app.alert.dismiss('fetch_count');
            }
        });
    },
})
