
/**
 * @class View.Views.Base.ForecastsConfigForecastByView
 * @alias DOTB.App.view.layouts.BaseForecastsConfigForecastByView
 * @extends View.Views.Base.ConfigPanelView
 */
({
    extendsFrom: 'ConfigPanelView',

    /**
     * @inheritdoc
     */
    _updateTitleValues: function() {
        this.titleSelectedValues = this.model.get('forecast_by');
    }
})
