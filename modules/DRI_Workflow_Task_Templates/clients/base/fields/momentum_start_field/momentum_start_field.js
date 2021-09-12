({
    extendsFrom: "EnumField",

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.type = 'enum';
        this.model.on("change:momentum_start_type", this.setMomentumStartFieldOptions, this);
        this.model.on("change:momentum_start_module", this.setMomentumStartFieldOptions, this);
        this.model.on("sync", this.setMomentumStartFieldOptions, this);
        this.setMomentumStartFieldOptions();
    },

    setMomentumStartFieldOptions: function () {
        if (this.model.get("momentum_start_type") === "parent_date_field"
          && !_.isEmpty(this.model.get("momentum_start_module"))) {
            var parent = app.data.createBean(this.model.get("momentum_start_module"));
            var options = {"": ""};

            _.each(parent.fields, function (field) {
                if (field.type === "date" || field.type === "datetime" || field.type === "datetimecombo") {
                    options[field.name] = app.lang.get(field.vname, parent.module);
                }
            });

            this.items = options;
            this.render();

            if (!options[this.model.get("productivity_start_field")]) {
                this.model.set("productivity_start_field", "");
            }
        }
    }
})
