

(function(app) {
    app.events.on('router:init', function(router) {
        var module = 'Reports';
        var routes = [
            {
                name: 'ReportsList',
                route: 'Reports',
                callback: function(params) {
                    var filterOptions;

                    if (params) {
                        var parsedParams = {filterModule: []};
                        // FIXME SC-5657 will handle url param parsing
                        var paramsArray = params.split('&');
                        _.each(paramsArray, function(paramPair) {
                            var keyValueArray = paramPair.split('=');
                            if (keyValueArray.length > 1) {
                                parsedParams[keyValueArray[0]] = keyValueArray[1].split(',');
                            }
                        });

                        if (!_.isEmpty(parsedParams.filterModule)) {
                            filterOptions = new app.utils.FilterOptions().config({
                                initial_filter_label: app.lang.get('LBL_MODULE_NAME', parsedParams.filterModule),
                                initial_filter: '$relate',
                                filter_populate: {
                                    'module': {$in: parsedParams.filterModule}
                                }
                            });
                        }
                    }

                    app.controller.loadView({
                        module: module,
                        layout: 'records',
                        filterOptions: filterOptions ? filterOptions.format() : null
                    });
                }
            },
            // This will be removed once we move Reports record view into lumia
            // For now, let's just catch all the edge cases that link to lumia record view
            // and reroute them
            {
                name: 'ReportsRecord',
                route: 'Reports/:id(/:action)',
                callback: function(id, action) {
                    var route = app.bwc.buildRoute('Reports', id);
                    app.router.redirect(route);
                }
            }
        ];

        app.router.addRoutes(routes);
    });
})(DOTB.App);
