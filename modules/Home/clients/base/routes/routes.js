(function (app) {
    app.events.on('router:init', function (router) {
        /*
         * Allow modules to extend routing rules.
         *
         * Manually create a route for the router.
         * The route argument may be a routing string or regular expression.
         */
        var homeOptions = {
            dashboard: 'dashboard',
            activities: 'activities'
        };

        var getLastHomeKey = function () {
            return app.user.lastState.buildKey('last-home', 'app-header');
        };

        var routes = [
            {
                name: 'activities',
                route: 'activities',
                callback: function () {
                    // when visiting activity stream, save last state of activities
                    // so future Home routes go back to activities
                    var lastHomeKey = getLastHomeKey();
                    app.user.lastState.set(lastHomeKey, homeOptions.activities);

                    app.controller.loadView({
                        layout: 'activities',
                        module: 'Activities'
                    });
                }
            },
            {
                name: 'home',
                route: 'Home',
                callback: function () {
                    var lastHomeKey = getLastHomeKey(),
                        lastHome = app.user.lastState.get(lastHomeKey);
                    var dashboardId = 0;
                    var self = app;
                    app.api.call("post", app.api.buildURL('me/preferences'), {}, {
                        success: function (data) {
                            dashboardId = (data.dashboard_id != 0) ? data.dashboard_id : 0;
                            if (dashboardId != 0) {

                                self.controller.loadView({
                                    module: 'Home',
                                    layout: 'record',
                                    modelId: dashboardId
                                });
                            } else if (lastHome === homeOptions.dashboard) {
                                self.controller.loadView({
                                    module: 'Home',
                                    layout: 'record'
                                });
                            } else if (lastHome === homeOptions.activities) {
                                self.router.redirect('#activities');
                            }
                        }
                    });


                }
            },
            {
                name: 'homeCreate',
                route: 'Home/create',
                callback: function () {
                    app.controller.loadView({
                        module: 'Home',
                        layout: 'record',
                        create: true
                    });
                }
            },
            {
                name: 'homeRecord',
                route: 'Home/:id',
                callback: function (id) {
                    // when visiting a dashboard, save last state of dashboard
                    // so future Home routes go back to dashboard
                    // var lastHomeKey = getLastHomeKey();
                    // app.user.lastState.set(lastHomeKey, homeOptions.dashboard);
                    if (app.user.attributes.type == 'admin') {
                        var lastHomeKey = getLastHomeKey();
                        app.user.lastState.set(lastHomeKey, homeOptions.dashboard);
                        app.api.call("create", app.api.buildURL('set_dashboard_id'), {
                            idUser: app.user.attributes.id,
                            idDashboard: id
                        });
                    }
                    app.controller.loadView({
                        module: 'Home',
                        layout: 'record',
                        action: 'detail',
                        modelId: id
                    });
                }
            }
        ];

        /*
         * Triggering the event on init will go over all those listeners
         * and add the routes to the router.
         */
        app.router.addRoutes(routes);
    });
})(DOTB.App);
