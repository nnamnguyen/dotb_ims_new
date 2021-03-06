
/**
 * @class View.Views.Base.Reports.RecordlistView
 * @alias DOTB.App.view.views.BaseReportsRecordlistView
 * @extends View.Views.Base.RecordListView
 */
({
    extendsFrom: 'RecordListView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.contextEvents = _.extend({}, this.contextEvents, {
            'list:editreport:fire': 'editReport',
            'list:schedulereport:fire': 'scheduleReport',
            'list:viewschedules:fire': 'viewSchedules'
        });
        this._super('initialize', [options]);
    },

    /**
     * Go to the Reports Wizard Edit page
     *
     * @param {Data.Bean} model Selected row's model.
     * @param {RowActionField} field
     */
    editReport: function(model, field) {
        var route = app.bwc.buildRoute('Reports', model.id, 'ReportsWizard');
        app.router.navigate(route, {trigger: true});
    },

    /**
     * Open schedule report drawer
     * @param model
     * @param field
     */
    scheduleReport: function(model, field) {
        var newModel = app.data.createBean('ReportSchedules');
        newModel.set({
            report_id: model.get('id'),
            report_name: model.get('name')
        });
        app.drawer.open({
            layout: 'create',
            context: {
                create: true,
                module: 'ReportSchedules',
                model: newModel
            }
        });
    },

    /**
     * View report schedules
     * @param model
     * @param field
     */
    viewSchedules: function(model, field) {
        var filterOptions = new app.utils.FilterOptions().config({
            initial_filter_label: model.get('name'),
            initial_filter: 'by_report',
            filter_populate: {
                'report_id': [model.get('id')]
            }
        });
        app.controller.loadView({
            module: 'ReportSchedules',
            layout: 'records',
            filterOptions: filterOptions.format()
        });
    }
})
