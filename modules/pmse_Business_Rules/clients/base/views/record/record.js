
({
    extendsFrom: 'RecordView',

    initialize: function (options) {
        this._super('initialize', [options]);
        this.context.on('button:design_businessrules:click', this.designBusinessRules, this);
        this.context.on('button:export_businessrules:click', this.warnExportBusinessRules, this);
        this.context.on('button:delete_businessrules:click', this.warnDeleteBusinessRules, this);
        this.context.on('button:edit_businessrules:click', this.warnEditBusinessRules, this);
    },

    warnEditBusinessRules: function(model){
        var verifyURL = app.api.buildURL(
                'pmse_Project',
                'verify',
                {id: model.get('id')},
                {baseModule: this.module}),
            self = this;
        app.api.call('read', verifyURL, null, {
            success: function(data) {
                if (!data) {
                    self.editClicked();
                } else {
                    app.alert.show('business-rule-design-confirmation',  {
                        level: 'confirmation',
                        messages: App.lang.get('LBL_PMSE_PROCESS_BUSINESS_RULES_EDIT', model.module),
                        onConfirm: function () {
                            self.editClicked();
                        },
                        onCancel: $.noop
                    });
                }
            }
        });
    },

    warnDeleteBusinessRules: function (model) {
        var verifyURL = app.api.buildURL(
                'pmse_Project',
                'verify',
                {id: model.get('id')},
                {baseModule: this.module}),
            self = this;
        this._modelToDelete = model;
        app.api.call('read', verifyURL, null, {
            success: function(data) {
                if (!data) {
                    app.alert.show('delete_confirmation', {
                        level: 'confirmation',
                        messages: self.getDeleteMessages(model).confirmation,
                        onConfirm: function () {
                            self.deleteModel();
                        },
                        onCancel: function () {
                            self._modelToDelete = null;
                        }
                    });
                } else {
                    app.alert.show('message-id', {
                        level: 'warning',
                        title: app.lang.get('LBL_WARNING'),
                        messages: app.lang.get('LBL_PMSE_PROCESS_BUSINESS_RULES_DELETE', model.module),
                        autoClose: false
                    });
                    self._modelToDelete = null;
                }
            }
        });
    },

    handleEdit: function(e, cell) {
        this.warnEditBusinessRules(this.model);
    },

    designBusinessRules: function(model) {
        var verifyURL = app.api.buildURL(
                'pmse_Project',
                'verify',
                {id: model.get('id')},
                {baseModule: this.module}),
            self = this;
        app.api.call('read', verifyURL, null, {
            success: function(data) {
                if (!data) {
                    app.navigate(this.context, model, 'layout/businessrules');
                } else {
                    app.alert.show('business-rule-design-confirmation',  {
                        level: 'confirmation',
                        messages: App.lang.get('LBL_PMSE_PROCESS_BUSINESS_RULES_EDIT', model.module),
                        onConfirm: function () {
                            app.navigate(this.context, model, 'layout/businessrules');
                        },
                        onCancel: $.noop
                    });
                }
            }
        });
    },

    warnExportBusinessRules: function (model) {
        var that = this;
        if (app.cache.get("show_br_export_warning")) {
            app.alert.show('show-br-export-confirmation', {
                level: 'confirmation',
                messages: app.lang.get('LBL_PMSE_IMPORT_EXPORT_WARNING') + "<br/><br/>"
                + app.lang.get('LBL_PMSE_EXPORT_CONFIRMATION'),
                onConfirm: function() {
                    app.cache.set("show_br_export_warning", false);
                    that.exportBusinessRules(model);
                },
                onCancel: $.noop
            });
        } else {
            that.exportBusinessRules(model);
        }
    },

    exportBusinessRules: function(model) {
        var url = app.api.buildURL(model.module, 'brules', {id: model.id}, {platform: app.config.platform});

        if (_.isEmpty(url)) {
            app.logger.error('Unable to get the Project download uri.');
            return;
        }

        app.api.fileDownload(url, {
            error: function(data) {
                // refresh token if it has expired
                app.error.handleHttpError(data, {});
            }
        }, {iframe: this.$el});
    },

    duplicateClicked: function() {
        var self = this,
            prefill = app.data.createBean(this.model.module);

        prefill.copy(this.model);
        this._copyNestedCollections(this.model, prefill);
        prefill.fields.rst_module.readonly = true;
        self.model.trigger('duplicate:before', prefill);
        prefill.unset('id');
        app.drawer.open({
            layout: 'create',
            context: {
                create: true,
                model: prefill,
                copiedFromModelId: this.model.get('id')
            }
        }, function(context, newModel) {
            if (newModel && newModel.id) {
                app.router.navigate(self.model.module + '/' + newModel.id, {trigger: true});
            }
        });

        prefill.trigger('duplicate:field', self.model);
    }
})
