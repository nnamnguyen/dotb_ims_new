/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
(function (app) {

    return {

        extendsFrom: "CreateView",

        /**
         * @param options
         */
        initialize: function (options) {
            this._super("initialize",[options]);
            this.model.on("change:dri_workflow_template_id", this._changeTemplate, this);
        },

        /**
         * @private
         */
        _changeTemplate: function (model) {
            this.getTemplate().xhr.done(function (arrs) {
                var template = app.data.createBean("DRI_Workflow_Templates", arrs);

                model.set("name", template.get("name"));
                model.set("type", template.get("type"));
                model.set("description", template.get("description"));
                model.set("team_name", template.get("team_name"));
                model.set("progress", template.get(0));
            });
        },

        /**
         * @returns {DOTB.Api.HttpRequest}
         */
        getTemplate: function () {
            var url = app.api.buildURL("DRI_Workflow_Templates", "read", {
                id: this.model.get("dri_workflow_template_id")
            });

            return app.api.call("view", url);
        }

    };

}(DOTB.App))
