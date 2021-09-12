/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
(function (app) {

    return {

        extendsFrom: "RecordView",

        /**
         * @param options
         */
        initialize: function (options) {
            this._super("initialize",[options]);
            this.model.fields.dri_workflow_template_name.readonly = true;
            this.model.fields.dri_workflow_template_id.readonly = true;

            var url = app.api.buildURL('DRI_Workflows', 'validate-license');

            app.api.call('read', url, null, {
                error: _.bind(this.licenseLoadError, this)
            });
        },

        licenseLoadError: function (error) {
            if (error.code === "invalid_license") {
                app.alert.show('invalid_license', {
                    level: 'error',
                    messages: error.message,
                    autoClose: true
                });
            }
        }

    };

}(DOTB.App))
