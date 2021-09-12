({
    extendsFrom:'CreateActionsView',

    initialize:function (options) {
        this._super("initialize",[options]);
        this.model.on("change:dri_subworkflow_template_id", this.setSortOrder, this);
        this.model.on("change:dri_subworkflow_template_id", this.setRelatedJourneyTemplate, this);
        this.setSortOrder();
        this.setRelatedJourneyTemplate();
    },

    setSortOrder: function () {
        if (!this.model.get("dri_subworkflow_template_id")) {
            return;
        }

        var url = app.api.buildURL('DRI_SubWorkflow_Templates', 'last-task', {
            id: this.model.get('dri_subworkflow_template_id')
        });

        app.api.call('read', url, null, {
            success: _.bind(function(data) {
                this.model.set("sort_order", data.sort_order + 1);
            }, this),
            error: _.bind(function() {
                this.model.set("sort_order", 1);
            }, this)
        });
    },

    setRelatedJourneyTemplate: function () {
        if (!this.model.get("dri_subworkflow_template_id")) {
            return;
        }

        var stage = app.data.createBean("DRI_SubWorkflow_Templates", {
            id: this.model.get("dri_subworkflow_template_id")
        });

        stage.fetch({
            success: _.bind(function () {
                this.model.set("dri_workflow_template_id", stage.get("dri_workflow_template_id"));
            }, this)
        });
    }
})
