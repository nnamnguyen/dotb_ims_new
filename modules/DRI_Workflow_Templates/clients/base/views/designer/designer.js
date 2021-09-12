/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
({
    extendsFrom: "DriWorkflowView",

    stageModule: "DRI_SubWorkflow_Templates",
    stageLink: "dri_subworkflows",
    activityStageId: "dri_subworkflow_template_id",
    parentActivityId: "parent_id",
    activitySortOrder: "sort_order",
    activityUrlField: "url",

    stagesSortable: true,
    activitiesSortable: true,
    modelLinks: true,
    stageLinks: true,
    activityLinks: true,

    /**
     * @param {object} activity
     * @returns {string}
     */
    getStatusClass: function (activity) {
        return "";
    },

    /**
     * @returns {string}
     */
    getTypeClass: function (activity) {
        return activity.get("activity_type") === "Tasks" ? activity.get("type") : "";
    },

    /**
     * @returns {void}
     */
    activityFormClicked: function () {
        // no op
    },

    /**
     * Adds a activity of given type to a stage
     *
     * @param {object} stage
     * @param {string} module
     */
    addActivity: function (stage, module) {
        var self = this;
        var stageContext = this.getStageContextById(stage.get("id"));

        var activity = app.data.createBean("DRI_Workflow_Task_Templates", {
            dri_subworkflow_template_id: stageContext.get("model").get("id"),
            dri_subworkflow_template_name: stageContext.get("model").get("name"),
            dri_workflow_template_id: stageContext.get("model").get("dri_workflow_template_id"),
            dri_workflow_template_name: stageContext.get("model").get("dri_workflow_template_name"),
            activity_type: module
        });

        var lastActivity = this.stages[stage.id] && _.last(_.toArray(this.stages[stage.id].activities));

        if (lastActivity) {
            activity.set("sort_order", parseInt(lastActivity.data.sort_order) + 1);
        }

        var context = stageContext.getChildContext({
            module: activity.module,
            model: activity,
            forceNew: true,
            create: true
        });

        app.drawer.open({
            module: activity.module,
            layout: 'create',
            context: context
        }, function (context, model) {
            // only reload if the model was saved
            if (model) {
                self.reloadData();
            }
        });
    },

    /**
     * Adds a activity of given type to a activity
     *
     * @param {object} activity
     * @param {string} module
     */
    addSubActivity: function (activity, module) {
        var order = activity.get(this.activitySortOrder) + ".";
        var stageContext = this.getStageContextById(activity.get("dri_subworkflow_template_id"));

        var children = (this.stages[activity.get(this.activityStageId)] && this.stages[activity.get(this.activityStageId)].activities[activity.id])
            ? this.stages[activity.get(this.activityStageId)].activities[activity.id].children
            : {};

        var last = _.last(_.values(children));

        if (last) {
            order = activity.get(this.activitySortOrder) + "." + (parseInt(last.model.get(this.activitySortOrder).split(".")[1]) + 1);
        } else {
            order = activity.get(this.activitySortOrder) + ".1";
        }

        var child = app.data.createBean("DRI_Workflow_Task_Templates", {
            dri_subworkflow_template_id: activity.get("dri_subworkflow_template_id"),
            dri_subworkflow_template_name: activity.get("dri_subworkflow_template_name"),
            dri_workflow_template_id: activity.get("dri_workflow_template_id"),
            dri_workflow_template_name: activity.get("dri_workflow_template_name"),
            sort_order: order,
            parent_id: activity.get("id"),
            parent_name: activity.get("name"),
            activity_type: module
        });

        var context = stageContext.getChildContext({
            module: child.module,
            model: child,
            forceNew: true,
            create: true
        });

        app.drawer.open({
            module: child.module,
            layout: 'create',
            context: context
        }, _.bind(function (context, model) {
            // only reload if the model was saved
            if (model) {
                this.reloadData();
            }
        }, this));
    },

    /**
     * @param {object} response
     */
    loadCompleted: function (response) {
        this._super("loadCompleted", [response]);
        if (this.$el) this.toggleMoreLess(this.MORE_LESS_STATUS.MORE);
    },

    /**
     * @param {object} activity
     * @returns {string}
     */
    getIcon: function (activity) {
        switch (activity.get("activity_type")) {
            case "Tasks":
                switch (activity.get("type")) {
                    case "customer_task":  return "fa-star icon-star";
                    case "milestone":      return "fa-trophy icon-trophy";
                    case "internal_task":  return "fa-user icon-user";
                    case "agency_task":    return "fa-city icon-building";
                    case "automatic_task": return "fa-refresh icon-refresh";
                }
                break;
            case "Meetings": return "fa-calendar icon-calendar";
            case "Calls":    return "fa-phone icon-phone";
        }
    },

    /**
     * @param {object} activity
     * @returns {string}
     */
    getStatusLabel: function (activity) {
        var points = activity.get("points") || 0;
        var label = points == 1 ? "LBL_WIDGET_POINT" : "LBL_WIDGET_POINTS";
        return points + " " + app.lang.get(label, "DRI_Workflows");
    },

    /**
     * @param {object} activity
     * @returns {string}
     */
    getIconTooltip: function (activity) {
        var activityTypeList = App.lang.getAppListStrings("dri_workflow_task_templates_activity_type_list");
        switch (activity.get("activity_type")) {
            case "Tasks":
                var typeList = App.lang.getAppListStrings("dri_workflow_task_templates_type_list");
                return typeList[activity.get("type")] || activityTypeList[activity.get("activity_type")];
            default:
                return activityTypeList[activity.get("activity_type")];
        }
    }
})
