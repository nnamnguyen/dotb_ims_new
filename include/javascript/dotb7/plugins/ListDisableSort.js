

(function (app) {
    app.events.on("app:init", function () {
        app.plugins.register('ListDisableSort', ['view'], {
            onAttach: function (component, plugin) {
                component._createCatalog = _.wrap(component._createCatalog, function (func, fields) {
                    _.each(fields, function (field) {
                        field.sortable = false;
                    });

                    return func.call(component, fields);
                });
            }
        });
    });
})(DOTB.App);
