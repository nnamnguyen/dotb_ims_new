({
    events: {
        'click .add-users-button': 'addUsersClicked'
    },

    initialize: function (options) {
        this._super("initialize", [options]);
        this.context.on('settings:save', this.saveConfig, this);
        this.context.on('settings:reload', this.loadData, this);
        this.configModel = new app.data.beanModel();
    },

    render: function () {
        this._super("render");

        if (this.configModel.get("user_limit") && this.configModel.get("current_users") >= this.configModel.get("user_limit")) {
            this.$(".add-users-button").hide();
        }
    },

    addUsersClicked: function () {
        this.context.trigger('users:add');
    },

    /**
     * Loads available settings
     */
    loadData: function () {
        app.api.call('read', app.api.buildURL(this.module, 'config'), {}, {
            success: _.bind(function (data) {
                this.setConfig(data);
                this.render();
            }, this),
            error: _.bind(function (error) {
                console.log(error);
            }, this)
        });
    },

    setConfig: function (data) {
        if (!_.isEmpty(data)) {
            _.each(data, function (value, key) {
                this.configModel.set(key, value);
            }, this);
        }
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

        var url = app.api.buildURL(this.module, 'config');

        app.api.call('update', url, data, {
            success: _.bind(function (data) {
                app.alert.dismiss('settings:save');

                app.alert.show('settings:success', {
                    level: 'success',
                    title: app.lang.getAppString('LBL_SUCCESS'),
                    messages: 'All settings saved.',
                    autoClose: true
                });

                this.setConfig(data);
                this.render();
                this.context.trigger("users:reload");
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
                        messages: 'Error when saving license: ' + app.lang.getAppString(error.message),
                        autoClose: true
                    });
                }

                this.loadData();
            }, this),
            complete: _.bind(function (data) {
                app.alert.dismiss('settings:save');
            }, this)
        });
    }
})
