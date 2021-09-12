({
    initialize: function(options) {
        app.view.View.prototype.initialize.call(this, options);
        this.context.off("template:import:finish", null, this);
        this.context.on("template:import:finish", this.importTemplate, this);
    },

    /**
     * @inheritdoc
     *
     * Sets up the file field to edit mode
     *
     * @param {View.Field} field
     * @private
     */
    _renderField: function(field) {
        app.view.View.prototype._renderField.call(this, field);
        if (field.name === 'template_import') {
            field.setMode('edit');
        }
    },

    /**
     * Import the Customer Insight Template File (.json)
     */
    importTemplate: function() {
        var self = this,
            projectFile = this.$('[name=template_import]');

        // Check if a file was chosen
        if (_.isEmpty(projectFile.val())) {
            app.alert.show('error_validation_process', {
                level:'error',
                messages: app.lang.get('LBL_CUSTOMER_JOURNEY_TEMPLATE_EMPTY_WARNING', self.module),
                autoClose: false
            });
        } else {
            app.alert.show('upload', {
                level: 'process',
                title: app.lang.get('LBL_CHECKING_IMPORT_UPLOAD', self.module),
                autoclose: false
            });

            var callbacks = {
                success: function (data) {
                    app.alert.dismiss('upload');

                    if (data.duplicate) {
                        app.alert.show('template-import-duplicate', {
                            level: 'error',
                            messages: app.lang.get('LBL_CUSTOMER_JOURNEY_TEMPLATE_IMPORT_DUPLICATE_NAME_ERROR', self.module, data.record),
                            autoClose: true,
                            autoCloseDelay: 20000
                        });
                    } else if (data.update) {
                        app.alert.show('template-import-confirm-update', {
                            level: 'confirmation',
                            messages: app.lang.get('LBL_CUSTOMER_JOURNEY_TEMPLATE_IMPORT_UPDATE_CONFIRM', self.module, data.record),
                            onConfirm: _.bind(self.doImport, self)
                        });
                    } else {
                        self.doImport();
                    }
                },
                error: function (error) {
                    app.alert.dismiss('upload');
                    app.alert.show('template-import-saved', {
                        level: 'error',
                        messages: error.error_message,
                        autoClose: false
                    });
                }
            };

            this.model.uploadFile('check_template_import', projectFile, callbacks, {
                deleteIfFails: true,
                htmlJsonFormat: true
            });
        }
    },

    doImport: function () {
        var self = this,
            projectFile = this.$('[name=template_import]');

        // Check if a file was chosen
        if (_.isEmpty(projectFile.val())) {
            app.alert.show('error_validation_process', {
                level:'error',
                messages: app.lang.get('LBL_CUSTOMER_JOURNEY_TEMPLATE_EMPTY_WARNING', self.module),
                autoClose: false
            });
        } else {
            app.alert.show('upload', {
                level: 'process',
                title: app.lang.get('LBL_IMPORTING_TEMPLATE', self.module),
                autoclose: false
            });

            var callbacks = {
                success: function (data) {
                    app.alert.dismiss('upload');
                    var route = app.router.buildRoute(self.module, data.record.id);
                    app.router.navigate(route, { trigger: true });

                    if (data.record.new_with_id) {
                        app.alert.show('template-import-saved', {
                            level: 'success',
                            messages: app.lang.get('LBL_CUSTOMER_JOURNEY_TEMPLATE_IMPORT_CREATE_SUCCESS', self.module, data.record),
                            autoClose: true,
                            autoCloseDelay: 20000
                        });
                    } else {
                        app.alert.show('template-import-saved', {
                            level: 'success',
                            messages: app.lang.get('LBL_CUSTOMER_JOURNEY_TEMPLATE_IMPORT_UPDATE_SUCCESS', self.module, data.record),
                            autoClose: true,
                            autoCloseDelay: 20000
                        });
                    }
                },
                error: function (error) {
                    app.alert.dismiss('upload');
                    app.alert.show('template-import-saved', {
                        level: 'error',
                        messages: error.error_message,
                        autoClose: false
                    });
                }
            };

            this.model.uploadFile('template_import', projectFile, callbacks, {
                deleteIfFails: true,
                htmlJsonFormat: true
            });
        }
    }
})
