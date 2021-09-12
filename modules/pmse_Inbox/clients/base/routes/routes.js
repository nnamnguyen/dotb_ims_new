
(function(app) {
    app.events.on('router:init', function(router) {
        var module = 'pmse_Inbox';
        var routes = [
            {
                name: 'show-case_layout_record_action',
                route: module + '/:id/layout/:layout/:record(/:action)',
                callback: function(id, layout, record, action) {
                    if (!this._moduleExists(module)) {
                        return;
                    }

                    var opts = {
                        module: module,
                        modelId: id,
                        layout: layout || 'record',
                        action: record,
                        record: action || 'detail'
                    };

                    app.controller.loadView(opts);
                }
            }
        ];

        app.router.addRoutes(routes);
    });
})(DOTB.App);
