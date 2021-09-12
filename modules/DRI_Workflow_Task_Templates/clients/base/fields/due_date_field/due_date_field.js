({
    extendsFrom: "EnumField",

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.type = 'enum';
        this.model.on("change:task_due_date_type", this.setDueDateTypeFieldOptions, this);
        this.model.on("change:due_date_module", this.setDueDateTypeFieldOptions, this);
        this.model.on("sync", this.setDueDateTypeFieldOptions, this);
        this.setDueDateTypeFieldOptions();
    },

    setDueDateTypeFieldOptions: function () {
        if (this.model.get("task_due_date_type") === "days_from_parent_date_field" && !_.isEmpty(this.model.get("due_date_module"))) {
            var parent = app.data.createBean(this.model.get("due_date_module"));
            var options = {"": ""};

            _.each(parent.fields, function (field) {
                if (field.type === "date" || field.type === "datetime" || field.type === "datetimecombo") {
                    options[field.name] = app.lang.get(field.vname, parent.module);
                }
            });

            this.items = options;
            this.render();

            if (!options[this.model.get("due_date_field")]) {
                this.model.set("due_date_field", "");
            }
        }
    }
})
