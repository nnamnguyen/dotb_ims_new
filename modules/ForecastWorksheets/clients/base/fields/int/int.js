
/**
 * @class View.Fields.Base.ForecastsWorksheets.IntField
 * @alias DOTB.App.view.fields.BaseForecastsWorksheetsIntField
 * @extends View.Fields.Base.IntField
 */
({
    extendsFrom: 'IntField',

    initialize: function(options) {
        // we need to make a clone of the plugins and then push to the new object. this prevents double plugin
        // registration across ExtendedComponents
        this.plugins = _.clone(this.plugins) || [];
        this.plugins.push('ClickToEdit');
        this._super("initialize", [options]);
    }
})
