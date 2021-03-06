
/**
 * @class View.Views.Base.ReportSchedules.ListHeaderpaneView
 * @alias DOTB.App.view.views.BaseReportSchedulesListHeaderpaneView
 * @extends View.Views.Base.ListHeaderpaneView
 */
({
    extendsFrom: 'ListHeaderpaneView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.context.on('button:create_button:click', this.create, this);
    },

    /**
     * Pass current report to 'create' view if report filter is applied
     */
    create: function() {
        var newModel = app.data.createBean('ReportSchedules');
        var currentFilter = this.context.get('currentFilterId');
        var filterOptions = this.context.get('filterOptions');
        // report filter is initially appied and has not been removed
        if (filterOptions && filterOptions.initial_filter === 'by_report' && currentFilter === 'by_report') {
            newModel.set({
                report_id: filterOptions.filter_populate.report_id[0],
                report_name: filterOptions.initial_filter_label
            });
        }
        app.drawer.open({
            layout: 'create',
            context: {
                create: true,
                module: 'ReportSchedules',
                model: newModel
            }
        }, function(context, model) {
            if (model && model.module === app.controller.context.get('module')) {
                app.controller.context.reloadData();
            }
        });
    }
})
