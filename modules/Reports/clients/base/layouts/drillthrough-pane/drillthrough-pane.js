
/**
 * @class View.Layouts.Reports.DrillthroughPaneLayout
 * @alias DOTB.App.view.layouts.ReportsDrillthroughPaneLayout
 * @extends View.Layout
 */
({
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        // configuration from clicked dashlet
        var config = this.context.get('dashConfig');

        var metadata = {
                component: 'saved-reports-chart',
                name: 'saved-reports-chart',
                type: 'saved-reports-chart',
                label: config.label || app.lang.get('LBL_DASHLET_SAVED_REPORTS_CHART', 'Reports'),
                description: 'LBL_DASHLET_SAVED_REPORTS_CHART_DESC',
                // module: this.context.get('module'), // this breaks Dashlet plugin at context.parent
                module: null,
                config: [],
                preview: []
            };

        var field = {
                type: 'chart',
                name: 'chart',
                label: 'LBL_CHART',
                view: 'detail',
                module: metadata.module
            };

        var component = {
                name: metadata.component,
                type: metadata.type,
                preview: true,
                context: this.context,
                module: metadata.module,
                custom_toolbar: 'no',
                chart: field
            };

        component.view = _.extend({module: metadata.module}, metadata.preview, component);

        this.initComponents([{
            layout: {
                type: 'dashlet',
                css_class: 'dashlets',
                config: false,
                preview: false,
                label: metadata.label,
                module: metadata.module,
                context: this.context,
                components: [
                    component
                ]
            }
        }], this.context);
        this.on('click:refresh_list_chart', this.refreshListChart, this);
    },

    /**
     * @inheritdoc
     */
    render: function() {
        var config = this.context.get('dashConfig');
        // Set the title of the side pane
        // label coming out of BWC html enoded, decode it first
        this.model.setDefault('title', $('<div/>').html(config.label).text());
        this._super('render');

        var dashlet = this.getComponent('dashlet').getComponent('saved-reports-chart');
        var config = this.context.get('dashConfig');
        var chartData = this.context.get('chartData');
        var reportData = this.context.get('reportData');
        var chartLabels = {groupLabel: config.groupLabel, seriesLabel: config.seriesLabel};
        this.context.set('chartLabels', chartLabels);
        var title = dashlet.$('.dashlet-title');

        // This will allow scrolling when drilling thru from Report detail view
        // but will respect the dashlet setting when drilling thru from SRC
        config.allowScroll = true;

        dashlet.settings.set(config);
        dashlet.reportData.set('rawChartParams', config);
        dashlet.reportData.set('rawReportData', reportData);
        // set reportData's rawChartData to the chartData from the source chart
        // this will trigger chart.js' change:rawChartData and the chart will update
        dashlet.reportData.set('rawChartData', chartData);

        return this;
    },

    /**
     * Refresh list and chart
     */
    refreshListChart: function() {
        var drawer = this.closestComponent('drawer').getComponent('drillthrough-drawer');
        drawer.updateList();
        var dashlet = this.getComponent('dashlet').getComponent('saved-reports-chart');
        dashlet.loadData();
    }
})
