
/**
 * @class View.Views.Base.Dashboards.RecordView
 * @alias DOTB.App.view.views.BaseDashboardsRecordView
 * @extends View.Views.Base.RecordView
 */
({
    extendsFrom: 'RecordView',

    /**
     * @inheritdoc
     */
    getDeleteMessages: function() {
        var messages = {};
        var modelName = app.lang.get(this.model.get('name'), this.model.get('dashboard_module'));

        messages.confirmation = app.lang.get('LBL_DELETE_DASHBOARD_CONFIRM', this.module, {name: modelName});
        messages.success = app.lang.get('LBL_DELETE_DASHBOARD_SUCCESS', this.module, {
            name: modelName
        });

        return messages;
    }
})
