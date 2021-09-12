

(function (app) {

    app.events.on("app:login:success", function () {
        app.cache.set("show_project_import_warning", true);
        app.cache.set("show_project_export_warning", true);
        app.cache.set("show_br_import_warning", true);
        app.cache.set("show_br_export_warning", true);
        app.cache.set("show_emailtpl_import_warning", true);
        app.cache.set("show_emailtpl_export_warning", true);
    });

})(DOTB.App);