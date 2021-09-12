
/**
 * @class View.Fields.Base.ForecastsWorksheets.CurrencyField
 * @alias DOTB.App.view.fields.BaseForecastsWorksheetsCurrencyField
 * @extends View.Fields.Base.CurrencyField
 */
({
    extendsFrom: 'CurrencyField',

    initialize: function(options) {
        // we need to make a clone of the plugins and then push to the new object. this prevents double plugin
        // registration across ExtendedComponents
        this.plugins = _.clone(this.plugins) || [];
        this.plugins.push('ClickToEdit');
        this._super("initialize", [options]);
    }
})
