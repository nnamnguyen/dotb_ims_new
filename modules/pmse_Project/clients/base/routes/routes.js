
(function(app) {
    app.events.on('router:init', function(router) {
        var module = 'pmse_Project';
        var routes = [
            {
                name: 'pd_record_layout',
                route: module + '/:id/layout/:layout',
                callback: function(id, layout) {
                    if (!app.router._moduleExists(module)) {
                        return;
                    }
                    app.router.record(module, id, null, layout);
                }
            }
        ];

        app.router.addRoutes(routes);
    });
})(DOTB.App);
