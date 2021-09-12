
/**
 * @class View.Layouts.Base.ForecastsConfigDrawerLayout
 * @alias DOTB.App.view.layouts.BaseForecastsConfigDrawerLayout
 * @extends View.Layouts.Base.ConfigDrawerLayout
 */
({
    extendsFrom: 'ConfigDrawerLayout',

    /**
     * @inheritdoc
     *
     * Checks Forecasts ACLs to see if the User is a system admin
     * or if the user has a developer role for the Forecasts module
     *
     * @inheritdoc
     */
    _checkModuleAccess: function() {
        var acls = app.user.getAcls().Forecasts,
            isSysAdmin = (app.user.get('type') == 'admin'),
            isDev = (!_.has(acls, 'developer'));

        return (isSysAdmin || isDev);
    },

    /**
     * Checks Forecasts config metadata to see if the correct Sales Stage Won/Lost settings are present
     *
     * @inheritdoc
     */
    _checkModuleConfig: function() {
        return app.utils.checkForecastConfig();
    }
})
