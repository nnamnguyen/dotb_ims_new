
/**
 * @class View.Fields.Base.ModuleField
 * @alias DOTB.App.view.fields.BaseModuleField
 * @extends View.Fields.Base.BaseField
 */
({
    format: function(value){
        value = app.lang.getModuleName(value, {plural: true});
        return value;
    }
})
