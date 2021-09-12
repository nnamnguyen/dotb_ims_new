({
    events: {
        "click a[name=save_button]": "saveConfig"
    },

    initialize: function (options) {
        this._super("initialize", [options]);
        this.context.on('settings:save', this.saveConfig, this);
        this.configModel = new app.data.createBean('DRI_Workflows');
        this.context.set("step", 1);
    },

    /**
     * Loads available settings.
     */
    loadData: function () {
        app.api.call('read', app.api.buildURL(this.module, 'config/enabled_modules'), {}, {
            success: _.bind(function (data) {
                if (!_.isEmpty(data)) {
                    this.missing_modules = data.missing_modules;
                    this.custom_modules = data.custom_modules;
                    _.each(data, function (value, key) {
                        this.configModel.set(key, value);
                    }, this);
                }

                this.render();
            }, this),
            error: _.bind(function (error) {
                console.log(error);
            }, this)});
    },

    /**
     * Save changes to config parameters
     */
    saveConfig: function () {
        var data = {};

        _.each(this.meta.fields, function (def) {
            data[def.name] = this.configModel.get(def.name);
        }, this);

        app.alert.show('settings:save', {
            level: 'process',
            title: app.lang.getAppString('LBL_LOADING')
        });

        var url = app.api.buildURL(this.module, 'config/enabled_modules');

        app.api.call('update', url, data, {
            success: _.bind(function (result) {
                app.alert.dismiss('settings:save');

                this.missing_modules = result.missing_modules;

                this.context.set("step", 2);

                app.alert.show('settings:success', {
                    level: 'success',
                    title: app.lang.getAppString('LBL_SUCCESS'),
                    messages: 'All settings saved.',
                    autoClose: true
                });

                this.render();
            }, this),
            error: _.bind(function (error) {
                if (error.code === "invalid_license") {
                    app.alert.show('settings:error', {
                        level: 'error',
                        messages: error.message,
                        autoClose: true
                    });
                } else {
                    app.alert.show('settings:error', {
                        level: 'error',
                        messages: 'Error when saving: ' + app.lang.getAppString(error.message),
                        autoClose: true
                    });
                }
            }, this),
            complete: _.bind(function (data) {
                app.alert.dismiss('settings:save');
            }, this)
        });
    }
})
