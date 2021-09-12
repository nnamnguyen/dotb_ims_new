({
    extendsFrom: 'HeaderpaneView',

    initialize: function (options) {
        this._super('initialize', [options]);
        this.title = app.lang.get('LBL_CONFIGURE_MODULES_CONTENT_TITLE', this.module);
        this.context.on('change:step', this.changeStep, this);

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
    },

    changeStep: function () {
        var field = this.getField("save_button");
        if (this.context.get("step") === 2) {
            field && field.hide();
        } else {
            field && field.show();
        }
    }
})
