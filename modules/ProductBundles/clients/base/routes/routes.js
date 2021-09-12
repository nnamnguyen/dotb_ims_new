
(function(app) {
    app.events.on('router:init', function(router) {
        var routes = [
            {
                name: 'productBundlesList',
                route: 'ProductBundles',
                callback: function() {
                    app.router.redirect('#Quotes');
                }
            },
            {
                name: 'productBundlesCreate',
                route: 'ProductBundles/create',
                callback: function() {
                    app.router.redirect('#Quotes');
                }
            },
            {
                name: 'productBundlesRecord',
                route: 'ProductBundles/:id',
                callback: function(id) {
                    app.router.redirect('#Quotes');
                }
            }
        ];
        app.router.addRoutes(routes);
    });
})(DOTB.App);
