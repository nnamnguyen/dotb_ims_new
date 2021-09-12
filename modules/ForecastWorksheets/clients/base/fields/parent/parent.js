
/**
 * @class View.Fields.Base.ForecastsWorksheets.ParentField
 * @alias DOTB.App.view.fields.BaseForecastsWorksheetsParentField
 * @extends View.Fields.Base.ParentField
 */
({
    extendsFrom: 'ParentField',

    _render: function () {
        if(this.model.get('parent_deleted') == 1) {
            // set the value for use in the template
            this.deleted_value = this.model.get('name');
            // override the template to use the delete one
            this.options.viewName = 'deleted';
        }
        this._super("_render");
    }
})
