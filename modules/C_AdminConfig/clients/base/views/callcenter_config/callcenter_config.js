({
    events: {
        'click #callcenter_config_btnAddRow': 'addRow',
        'click #callcenter_config_btnDelRow': 'delRow',
    },
    initialize: function (options) {
        this._super('initialize', [options]);

        this.loadData(options);

        this.context.on("save", _.bind(this.save, this));
        this.context.on("cancel", _.bind(this.cancel, this));
    },

    addRow: function () {
        var $table = $('#callcenter_config_tableConfig');
        $table.find('tbody').append($table.find('tfoot').html());
        $table.find('tbody').find('.callcenter_config_user').last().select2();
    },

    delRow: function (e) {
        $(e.currentTarget).closest('tr').remove();
    },

    loadData: function (options) {
        options = options || {};
        _.extend(options, {
            success: _.bind(function (res) {
                this.data = res;
                this.render();
                $('#callcenter_config_tableConfig').find('.callcenter_config_user:visible').select2();
            }, this)
        });
        app.api.call("read", app.api.buildURL('callcenter/config'), null, options);
    },

    showErrorAlert: function (error) {
        app.alert.show('error', {
            level: 'error',
            messages: error.message
        });
    },

    showLoading: function () {
        app.alert.show('loading', {
            level: 'process',
            title: 'saving'
        });
    },

    showSuccessAlert: function () {
        app.alert.show('success', {
            level: 'success',
            messages: "",
            autoClose: true
        });
    },

    save: function () {
        this.showLoading();
        var options = {
            success: _.bind(function (data) {
                this.showSuccessAlert();
                app.alert.dismiss('loading');
            }, this),
            error: _.bind(function (error) {
                if (error.status === 412 && !error.request.metadataRetry) {
                    this.handleMetadataSyncError(error);
                } else {
                    this.showErrorAlert(error);
                }
                app.alert.dismiss('loading');
            }, this)
        };
        var result = {
            supplier: $('#callcenter_config_slcSupplier').val(),
            port: $('#callcenter_config_port').val(),
            username: $('#callcenter_config_username').val(),
            password: $('#callcenter_config_password').val(),
            config: []
        };

        $('#callcenter_config_tableConfig tbody tr').each(function () {
            var _this = $(this);
            result.config.push({
                ext: _this.find('.callcenter_config_ext').val(),
                ip: _this.find('.callcenter_config_ip').val(),
                chanel: _this.find('.callcenter_config_chanel').val(),
                context: _this.find('.callcenter_config_context').val(),
                user: _this.find('.callcenter_config_user option:selected').val(),
            });
        });

        app.api.call("update", app.api.buildURL('callcenter/saveConfig'), result, options);
    },

    cancel: function () {
        app.router.navigate("#bwc/index.php?module=Administration", {trigger: true});
    }
})
