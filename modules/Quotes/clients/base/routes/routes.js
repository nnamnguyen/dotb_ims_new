
(function(app) {
    app.events.on('router:init', function(router) {
        var routes = [{
            name: 'quotesCompatibility',
            route: 'Quotes/create',
            callback: function() {
                app.router.record('Quotes', 'create');
            }
        }];

        /*
         * Triggering the event on init will go over all those listeners
         * and add the routes to the router.
         */
        app.router.addRoutes(routes);
    });
})(DOTB.App);
