({
    extendsFrom: 'RecordView',
    initialize: function (options) {
        this._super('initialize', [options]);
        this.context.on('button:update_code_server:click', this.updateCodeServer);
        this.context.on('button:recheckapplicense:click', this.reCheckAppLicense);

    },
    updateCodeServer: function () {
        App.alert.show('loading', {
            level: 'process',
            title: 'loading'
        });
        App.api.call('create', App.api.buildURL('ims/server/update_code'), {domain: this.attributes.model.get('name')}, {
            success: function (res) {
                App.alert.dismiss('loading');
                if (res.success) {
                    App.alert.show('saved', {
                        level: 'success',
                        messages: '',
                        autoClose: true
                    });
                } else {
                    App.alert.show('errored', {
                        level: 'error',
                        messages: '',
                        autoClose: true
                    });
                }
            }
        });
    },
    reCheckAppLicense: function () {
        var _self = this;
        App.alert.show('loading', {
            level: 'process',
            title: 'loading'
        });
        App.api.call('create', App.api.buildURL('ims/server/recheck-app-license'), {domain: this.attributes.model.get('name'),protocol: this.attributes.model.get('protocol')}, {
            success: function (res) {
                App.alert.dismiss('loading');
                if (res.success) {
                    App.alert.show('saved', {
                        level: 'success',
                        messages: '',
                        autoClose: true
                    });

                    /**
                     *  refresh supanel
                     */
                    var subpanelCollection = _self.attributes.model.getRelatedCollection('c_sitedeployment_c_parentapplicense_1');
                    subpanelCollection.fetch({relate: true});
                } else {
                    App.alert.show('errored', {
                        level: 'error',
                        messages: '',
                        autoClose: true
                    });
                }
            }
        });
    }
})
