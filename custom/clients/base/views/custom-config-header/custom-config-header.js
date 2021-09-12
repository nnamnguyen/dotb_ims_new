/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 *
 * @package FTE Usage Tracking
 */


({

    plugins: ['Editable'],

    initialize: function (options) {
        this._super('initialize', [options]);

        this.context.on("save_config", _.bind(this.saveConfig, this));
        this.context.on("cancel_config", _.bind(this.cancelConfig, this));
    },

    showErrorAlert: function (error) {
        if (!this instanceof app.view.View) {
            app.logger.error('This method should be invoked by Function.prototype.call(), passing in as argument' +
                'an instance of this view.');
            return;
        }
        var name = 'invalid-data';
        app.alert.show(name, {
            level: 'error',
            messages: error.message
        });
    },

    showSuccessAlert: function () {
        if (!this instanceof app.view.View) {
            app.logger.error('This method should be invoked by Function.prototype.call(), passing in as argument' +
                'an instance of this view.');
            return;
        }
        var name = 'saved';
        app.alert.show(name, {
            level: 'success',
            messages: "",
            autoClose: true
        });
    },

    saveConfig: function () {
        this.getField('save_button').setDisabled(true);
        var options = {
            success: _.bind(function (data) {
                this.model.set(data, {silent: true});
                this.model.setSyncedAttributes(data);
                this.showSuccessAlert();
                this.getField('save_button').setDisabled(false);
            }, this),
            error: _.bind(function (error) {
                if (error.status === 412 && !error.request.metadataRetry) {
                    this.handleMetadataSyncError(error);
                }
                else {
                    this.showErrorAlert(error);
                }
                this.getField('save_button').setDisabled(false);
            }, this),
        };

        //if(this.hasUnsavedChanges()){
        app.api.call("create", app.api.buildURL('configurator'), this.model, options);
        //}
    },

    cancelConfig: function () {
        app.router.navigate("#bwc/index.php?module=Administration", {trigger: true});
    },

    hasUnsavedChanges: function () {
        var changedAttributes, unsavedFields;

        if (this.resavingAfterMetadataSync)
            return false;

        changedAttributes = this.model.changedAttributes(this.model.getSynced());

        if (_.isEmpty(changedAttributes)) {
            return false;
        }

        // check whether the changed attributes are among the editable fields
        unsavedFields = _.keys(changedAttributes);

        return !_.isEmpty(unsavedFields);
    },

    handleMetadataSyncError: function (error) {
        var self = this;
        //On a metadata sync error, retry the save after the app is synced
        self.resavingAfterMetadataSync = true;

        app.once('app:sync:complete', function () {
            error.request.metadataRetry = true;
            self.model.once('sync', function () {
                self.resavingAfterMetadataSync = false;
                //self.model.changed = {};
                app.router.refresh();
            });
            //add a new success callback to refresh the page after the save completes
            error.request.execute(null, app.api.getMetadataHash());
        });
    },
})