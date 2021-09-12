/**
 * @author Emil Kilhage <emil.kilhage@addoptify.com>
 */
({
    initialize: function (options) {
        this._super("initialize", [options]);
        this.context.on("button:export_button:click", this.exportClicked, this);

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

    exportClicked: function () {
        app.alert.show('massexport_loading', {
            level: 'process',
            title: app.lang.get('LBL_LOADING')
        });

        app.api.fileDownload(
            app.api.buildURL(this.module, 'export', {
                id: this.model.id
            }, {
                platform: 'base'
            }), {
                complete: function() {
                    app.alert.dismiss('massexport_loading');
                }
            }, {
                iframe: this.$el
            }
        );
    }
})
