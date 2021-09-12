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
 * @class View.Layouts.Base.ForecastsConfigDrawerContentLayout
 * @alias DOTB.App.view.layouts.BaseForecastsConfigDrawerContentLayout
 * @extends View.Layouts.Base.ConfigDrawerContentLayout
 */
({
    extendsFrom: 'ConfigDrawerContentLayout',

    notificationsTitle: undefined,
    notificationsText: undefined,

    /**
     * @inheritdoc
     * @override
     */
    _initHowTo: function() {
        this.notificationsTitle = app.lang.getModString('LBL_NOTIFICATIONS_CONFIG_TITLE', 'ops_Backups');
        this.notificationsText = app.lang.getModString('LBL_NOTIFICATIONS_CONFIG_HELP', 'ops_Backups');
    },

    /**
     * @inheritdoc
     * @override
     */
    _switchHowToData: function(helpId) {
        switch(helpId) {
            case 'config-notifications':
                this.currentHowToData.title = this.notificationsTitle;
                this.currentHowToData.text = this.notificationsText;
                break;
        }
    }
})
