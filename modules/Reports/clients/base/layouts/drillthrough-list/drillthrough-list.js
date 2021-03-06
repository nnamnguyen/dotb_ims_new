
/**
 * @class View.Layouts.Base.Reports.DrillthroughListLayout
 * @alias DOTB.App.view.layouts.BaseReportsDrillthroughListLayout
 * @extends View.Views.Base.ListLayout
 */
({
    extendsFrom: 'ListLayout',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        // from this level down we should use target module instead of Reports
        // model needs to be a target module bean so some list level operations can work
        // for different module
        // for example, the function _filterMeta relies on the correct model
        var chartModule = options.context.get('chartModule');
        options.context.set('model', app.data.createBean(chartModule));
        options.context.set('collection', app.data.createBeanCollection(chartModule));

        options.module = chartModule;
        options = this._removeFieldSorting(options);
        this._super('initialize', [options]);
    },

    /**
     * Set the sortable property to false for all fields
     * We don't want to sort in the drill-through drawer
     *
     * @param {Object} options Backbone view options
     * @return {Object} options with the fields' sortable property set to false
     * @private
     */
    _removeFieldSorting: function(options) {
        var listMeta = app.metadata.getView(options.module, 'list');
        var fields = _.first(listMeta.panels).fields;
        var unsortableFields = _.each(fields, function(field) {
            field.sortable = false;
        });

        var panels = [{fields: unsortableFields}];
        options.meta.components[2].xmeta.panels = panels;
        return options;
    }
})
