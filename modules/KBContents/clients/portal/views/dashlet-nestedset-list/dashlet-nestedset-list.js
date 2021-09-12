
/**
 * @class View.Views.KBContents.Portal.DashletNestedsetListView
 * @alias DOTB.App.view.views.KBContents.PortalDashletNestedsetListView
 */
({
    extendsFrom: 'BaseKBContentsDashletNestedsetListView',

    /**
     * @inheritdoc
     */
    onNestedSetSyncComplete: function(collection) {
        if (this.disposed || this.collection.root !== collection.root) {
            return;
        }
    }
})
