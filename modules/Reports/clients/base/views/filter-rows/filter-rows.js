
/**
 * @class View.Views.Base.Reports.FilterRowsView
 * @alias DOTB.App.view.views.BaseReportsFilterRowsView
 * @extends View.Views.Base.FilterRowsView
 */
({
    extendsFrom: 'FilterRowsView',

    /**
     * @inheritdoc
     */
    loadFilterFields: function(module) {
        this._super('loadFilterFields', [module]);
        // last_run_date is a related datetime fields and shouldn't rely on its id_name
        if (this.fieldList && this.fieldList.last_run_date) {
            delete this.fieldList.last_run_date.id_name;
        }
    }
})
