(function (app) {
    app.events.on("router:init", function () {
        var routes = [];
        var hmods = app.config.hybrid_modules;
        if (!_.isEmpty(hmods)) {
            _.each(hmods, function (module) {
                if (module != 'Meetings')
                    routes.push({
                        // This will be removed once we move Reports record view into lumia
                        // For now, let's just catch all the edge cases that link to lumia record view
                        // and reroute them

                        name: module + 'Record',
                        route: module + '/:id(/:action)',
                        callback: function (id, action) {
                            var route = app.bwc.buildRoute(module, id);
                            if (id == 'create')
                                route = app.bwc.buildRoute(module, '', app.bwc.getAction(id));
                            if (id == 'ListView')
                                route = '#' + module;
                            app.router.redirect(route);
                        }
                    });
            });
        }
        app.router.addRoutes(routes);
    });
    app.events.on('app:view:change', function () {
        if (!_.isEmpty(App.user.attributes)) {
            var r = app.router.getFragment();
            if (typeof app.config.dotbheart != "undefined" && typeof app.config.dotbheart.heartbeat != "undefined") {
                var d = app.date(app.config.dotbheart.heartbeat);
                if (d.isBefore(new Date()) && r != 'C_AdminConfig/layout/license'
                    && r != 'bwc/index.php?module=Administration&action=index'
                    && r != 'bwc/index.php?module=Administration&action=Upgrade'
                    && r != 'bwc/index.php?module=Administration&action=repair') {
                    app.router.redirect('#C_AdminConfig/layout/license');
                }
            } else {
                if (r != 'C_AdminConfig/layout/license'
                    && r != 'bwc/index.php?module=Administration&action=index'
                    && r != 'bwc/index.php?module=Administration&action=Upgrade'
                    && r != 'bwc/index.php?module=Administration&action=repair') {
                    app.router.redirect('#C_AdminConfig/layout/license');
                }
            }
        }
    });
})(DOTB.App);