
/**
 * @class View.Fields.Base.Forecasts.DateField
 * @alias DOTB.App.view.fields.BaseForecastsDateField
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

        if (this.options && this.options.def && this.options.def.click_to_edit) {
            this.plugins = _.union(this.plugins, [
                'ClickToEdit'
            ]);
        }

        return this;
    }
})
