
({
    events: {
        'change .icon': 'changeIcon',
    },
    initialize: function (options) {
        this._super('initialize', [options]);

        this.loadData(options);

        this.context.on("save_icon", _.bind(this.saveIcon, this));
        this.context.on("cancel_icon", _.bind(this.cancelIcon, this));
    },

    loadData: function (options) {
        options = options || {};
        _.extend(options, {
            success: _.bind(function (res) {
                this.customData = res;
                this.render();
            }, this)
        });

        app.api.call("read", app.api.buildURL('get_change_module_icon'), null, options);
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

    saveIcon: function (options) {
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
        var result = {};
        $('.module-icon').each(function () {
            var module = $(this).find('.modulename').text();
            var val = $(this).find('.icon').val();
            var check = val.indexOf('/');
            if(check != -1)
                result[module] = {
                    type: 'image',
                    src: val
                }
            else
                result[module] = {
                    type: 'icon',
                    src: val
                }

          // result[a] = {type:icon/images, src:val()}
        });
        var data ={data:result};
        app.api.call("update", app.api.buildURL('set_change_module_icon'), data, options);
    },

    cancelIcon: function () {
        app.router.navigate("#bwc/index.php?module=Administration", {trigger: true});
    },

    changeIcon: function (e) {
        var pos = e.srcElement.closest('tr');
        var val = e.srcElement.value;
        $(pos).find('.preview').children().remove();
        if(val.indexOf('/') !=-1)
            $(pos).find('.preview').append('<img style="width:30px; height: 30px" src="'+val+'">');
        else
            $(pos).find('.preview').append('<i style="font-size:30px" class="'+val+'"></i>');
    }

})
