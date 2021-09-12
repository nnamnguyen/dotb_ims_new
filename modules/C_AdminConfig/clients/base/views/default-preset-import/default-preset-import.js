({
    initialize: function (options) {
        this._super('initialize', [options]);

        this.loadData(options);

        this.context.on("save_config", _.bind(this.saveConfig, this));
        this.context.on("cancel_config", _.bind(this.cancelConfig, this));
    },

    loadData: function (options) {
        options = options || {};

        _.extend(options, {
            success: _.bind(function (data) {
                this.customData = data;
            }, this)
        });

        app.api.call("read", app.api.buildURL('get-default-preset-import'), null, options);
    },

    showErrorAlert: function (error) {
        var name = 'invalid-data';
        app.alert.show(name, {
            level: 'error',
            messages: error.message
        });
    },

    showLoading: function () {
        var name = 'loading';
        app.alert.show(name, {
            level: 'process',
            title: 'saving'
        });
    },

    showSuccessAlert: function () {
        var name = 'saved';
        app.alert.show(name, {
            level: 'success',
            messages: "",
            autoClose: true
        });
    },

    saveConfig: function () {
        this.getField('save_button').setDisabled(true);
        this.showLoading();
        var options = {
            success: _.bind(function (data) {
                this.showSuccessAlert();
                this.getField('save_button').setDisabled(false);
                app.alert.dismiss('loading');
            }, this),
            error: _.bind(function (error) {
                if (error.status === 412 && !error.request.metadataRetry) {
                    this.handleMetadataSyncError(error);
                } else {
                    this.showErrorAlert(error);
                }
                this.getField('save_button').setDisabled(false);
                app.alert.dismiss('loading');
            }, this),
        };

        var data = {
            default_mapping_prospect: $('select[name="default_mapping_prospect"]').val(),
            default_mapping_lead: $('select[name="default_mapping_lead"]').val(),
            default_mapping_contact: $('select[name="default_mapping_contact"]').val()
        };
        app.api.call("update", app.api.buildURL('set-default-preset-import'), data, options);
    },

    cancelConfig: function () {
        app.router.navigate("#bwc/index.php?module=Administration", {trigger: true});
    },

    handleMetadataSyncError: function (error) {
        //On a metadata sync error, retry the save after the app is synced
        var self = this;
        self.resavingAfterMetadataSync = true;

        app.once('app:sync:complete', function () {
            error.request.metadataRetry = true;
            self.model.once('sync', function () {
                self.resavingAfterMetadataSync = false;
                app.router.refresh();
            });
            error.request.execute(null, app.api.getMetadataHash());
        });
    },
})