
/**
 * @class View.Fields.Base.ForecastsWorksheets.DateField
 * @alias DOTB.App.view.fields.BaseForecastsWorksheetsDateField
 * @extends View.Fields.Base.DateField
 */
({
    extendsFrom: 'DateField',

    /**
     * @inheritdoc
     *
     * Add `ClickToEdit` plugin to the list of required plugins.
     */
    _initPlugins: function() {
        this._super('_initPlugins');

        this.plugins = _.union(this.plugins, [
            'ClickToEdit'
        ]);

        return this;
    }
})
