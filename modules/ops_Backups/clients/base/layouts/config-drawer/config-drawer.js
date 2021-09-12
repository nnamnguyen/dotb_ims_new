/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 */
/**
 * @class View.Layouts.Base.ForecastsConfigDrawerLayout
 * @alias DOTB.App.view.layouts.BaseForecastsConfigDrawerLayout
 * @extends View.Layouts.Base.ConfigDrawerLayout
 */
({
    extendsFrom: 'ConfigDrawerLayout',


    _checkConfigMetadata: function(){
        return true;
    },

    /**
     * @inheritdoc
     *
     * Checks Forecasts ACLs to see if the User is a system admin
     * or if the user has a developer role for the Forecasts module
     *
     * @override
     */
    _checkModuleAccess: function() {
        var acls = app.user.getAcls().ops_Backups,
            isSysAdmin = (app.user.get('type') == 'admin'),
            isDev = (!_.has(acls, 'developer'));

        return (isSysAdmin || isDev);
    },

})