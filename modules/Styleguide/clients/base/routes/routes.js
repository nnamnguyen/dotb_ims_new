
(function(app) {
    app.events.on('router:init', function() {
        var routes = [
            {
                name: 'sg_index',
                route: 'Styleguide',
                callback: function() {
                    app.controller.loadView({
                        module: 'Styleguide',
                        layout: 'styleguide',
                        chapter_name: 'home',
                        content_name: null
                    });
                }
            },
            {
                name: 'sg_module',
                route: 'Styleguide/:layout/:resource',
                callback: function(layout, resource) {
                    var chapter_name = '',
                        content_name = '';
                    switch (layout) {
                        case 'docs':
                            //route: "Styleguide/docs/base"
                            //route: "Styleguide/docs/base-grid"
                        case 'fields':
                            //route: "Styleguide/fields/text"
                        case 'views':
                            //route: "Styleguide/views/list"
                            chapter_name = layout;
                            content_name = resource;
                            break;
                        case 'layout':
                            //route: "Styleguide/layout/records"
                            layout = resource;
                            content_name = 'module';
                            break;
                        default:
                            app.logger.warn('Invalid route: ' + layout + '/' + resource);
                            break;
                    }
                    app.controller.loadView({
                        module: 'Styleguide',
                        layout: layout,
                        chapter_name: chapter_name,
                        content_name: content_name,
                        skipFetch: true
                    });
                }
            }
        ];

        app.router.addRoutes(routes);
    });
})(DOTB.App);
