

/**
 * @class View.Fields.Base.DashboardsNameField
 * @alias App.view.fields.BaseDashboardsNameField
 * @extends View.Fields.Base.NameField
 */
({
    /**
     * Formats the value to be used in handlebars template and displayed on
     * screen. We are overriding this method to translate labels in the name
     * field within the Dashboard module.
     * @override
     */
    format: function(value) {
        return app.lang.get(value, this.model.get('dashboard_module'));
    }
})
