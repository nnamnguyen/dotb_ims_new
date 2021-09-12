/**
 * @class View.Views.Base.DashboardsRecordlistView
 * @alias DOTB.App.view.views.BaseDashboardsRecordlistView
 * @extends View.Views.Base.RecordlistView
 */
({
    // events: {
    //     'click a[name="copy_to_user"]': 'searchDrawer',
    //     'click a[name="copy_to_team"]': 'searchDrawer',
    //     'click a[name="copy_to_role"]': 'searchDrawer',
    // },
    extendsFrom: 'RecordlistView',

    /**
     * @inheritdoc
     */

    getDeleteMessages: function (model) {
        var messages = {};
        var modelName = app.lang.get(model.get('name'), model.get('dashboard_module'));

        messages.confirmation = app.lang.get('LBL_DELETE_DASHBOARD_CONFIRM', this.module, {name: modelName});
        messages.success = app.lang.get('LBL_DELETE_DASHBOARD_SUCCESS', this.module, {
            name: modelName
        });
        return messages;
    },
    // searchDrawer: function (current) {debugger;
    //     alert();
        //     var layout = 'selection-list';
        //     var context = {
        //         module: searchModule,
        //         fields: this.getSearchFields(),
        //         filterOptions: this.getFilterOptions()
        //     };
        //
        //     if (!!this.def.isMultiSelect) {
        //         layout = 'multi-selection-list';
        //         _.extend(context, {
        //             preselectedModelIds: _.clone(this.model.get(this.def.id_name)),
        //             maxSelectedRecords: this._maxSelectedRecords,
        //             isMultiSelect: true
        //         });
        //     }
        //
        //     app.drawer.open({
        //         layout: layout,
        //         context: context
        //     }, _.bind(this.setValue, this));
    // },
})
