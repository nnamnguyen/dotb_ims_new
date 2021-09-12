/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * @package FTE Usage Tracking
 */


(function (app) {
    app.events.on('router:init', function () {
        var routes = [
            {
                route: 'fte-config',
                name: 'fte-config',
                callback: function () {
                    if (!(App.user.get("type") === "admin")) {
                        app.controller.loadView({
                            module: 'Configurator',
                            layout: 'access-denied'
                        });
                    }
                    else {
                        app.controller.loadView({
                            module: 'Configurator',
                            layout: 'custom-config'
                        });
                    }
                }
            },
        ];

        app.router.addRoutes(routes);
    });
})(DOTB.App);