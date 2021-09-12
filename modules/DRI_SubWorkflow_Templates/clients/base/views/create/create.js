({
    extendsFrom:'CreateView',

    initialize:function (options) {
        this._super("initialize",[options]);
        this.model.on("change:dri_workflow_template_id", this.setSortOrder, this);
        this.setSortOrder();
    },

    setSortOrder: function () {
        if (!this.model.get("dri_workflow_template_id")) {
            return;
        }

        if (this.model.get("sort_order")) {
            return;
        }

        var url = app.api.buildURL('DRI_Workflow_Templates', 'last-stage', {
            id: this.model.get('dri_workflow_template_id')
        });

        app.api.call('read', url, null, {
            success: _.bind(function(data) {
                this.model.set("sort_order", data.sort_order + 1);
            }, this),
            error: _.bind(function() {
                this.model.set("sort_order", 1);
            }, this)
        });
    }
})
