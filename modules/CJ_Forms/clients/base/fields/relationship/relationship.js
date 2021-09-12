({
    extendsFrom: "BaseField",

    events: {
        "change .relationship-select": "changeRelationship"
    },

    initialize: function(options) {
        this._super("initialize", [options]);
        this.model.on("change:activity_module", this.changeActivityModule, this);
    },

    changeRelationship: function(ev) {
        var value = ev.currentTarget.value;
        var index = $(ev.currentTarget).data("index");
        var relationship = this.model.get("relationship") || [];
        var currentValue = relationship[index].relationship;
        var module = relationship[index].module;
        relationship[index].relationship = value;

        var bean = app.data.createBean(module);

        if (value === "self") {
            relationship = relationship.slice(0, index + 1);
        } else if (currentValue !== value) {
            var def = bean.fields[value];
            var rel = app.metadata.getRelationship(def.relationship);

            if (relationship.length !== (index + 1)) {
                relationship = relationship.slice(0, index + 1);
            }

            relationship.push({
                module: rel.lhs_module !== module ? rel.lhs_module : rel.rhs_module,
                relationship: "self",
                filters: []
            });
        }

        this.model.set("relationship", relationship);
        this.render();
    },

    changeActivityModule: function () {
        var activityModule = this.model.get("activity_module");
        var relationship = this.model.get("relationship") || [];

        if (!relationship || (relationship.length && relationship[0].module === activityModule)) {
            return;
        }

        if (activityModule) {
            this.model.set("relationship", [
                {
                    module: activityModule,
                    relationship: "self",
                    filters: []
                }
            ]);
        } else {
            this.model.set("relationship", []);
        }

        this.render();
    },

    getRelationOptionLabel: function(def, module) {
        return app.lang.get(def.vname, module) + " (" + def.name + ")";
    },

    getRelationshipsForModule: function(module) {
        var options = {
            "self": "self (" + app.lang.get("LBL_MODULE_NAME", module) + ")"
        };

        var bean = app.data.createBean(module);

        _.each(bean.fields, _.bind(function (def) {
            if (def.type !== "link") {
                return;
            }

            var rel = app.metadata.getRelationship(def.relationship);

            if (!rel) {
                return;
            }

            var relModule = rel.lhs_module !== module ? rel.lhs_module : rel.rhs_module;
            var meta = app.metadata.getModule(relModule);

            if (def.vname &&
                meta &&
                !meta.isBwcEnabled &&
                !_.includes(["ForecastWorksheets"], relModule) &&
                def.name &&
                !_.includes([
                    "created_by_link",
                    "modified_user_link",
                    "activities",
                    "activities_users",
                    "activities_teams",
                    "comments",
                    "commentlog_link",
                    "currencies",
                    "locked_fields_link",
                    "following_link",
                    "favorite_link",
                    "tag_link",
                    "teams",
                    "team_link",
                    "team_count_link",
                    "email_attachment_for",
                    "assigned_user_link",
                    "current_cj_activity_at",
                    "current_activity_call",
                    "current_activity_meeting",
                    "current_activity_task",
                    "current_stage_at",
                    "current_stage_link",
                    "dri_workflow_template_link",
                    "dri_subworkflow_template_link",
                    "cj_activity_tpl_link",
                    "blocked_by_link"
            ], def.name)) {
                options[def.name] = this.getRelationOptionLabel(def, module);
            }
        }, this));

        return options;
    },

    _render: function() {
        var relationship = this.model.get("relationship") || [];

        this.values = _.map(relationship, _.bind(function (rel, index) {
            var prev = relationship[index - 1];

            return _.extend({}, rel, {
                title: index === 0 ?
                    app.lang.get("LBL_MODULE_NAME_SINGULAR", rel.module) :
                    this.getRelationOptionLabel(
                        app.data.createBean(prev.module).fields[prev.relationship],
                        prev.module
                    ),
                options: this.getRelationshipsForModule(rel.module)
            });
        }, this));

        this._super("_render");
    }
})
