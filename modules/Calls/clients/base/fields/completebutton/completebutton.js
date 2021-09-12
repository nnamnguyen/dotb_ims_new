({
    extendsFrom: 'RowactionField',

    initialize: function (options) {
        this.events = _.extend({}, this.events, options.def.events, {
            'click [name="record-close"]': 'closeClicked'
        });

        this._super('initialize', [options]);
        this.type = 'rowaction';
    },

    closeClicked: function () {
        var self = this;
        if (this.model.get('status') == 'Held') return;
        this.model.set('status', 'Held');
        this.model.save({}, {
            success: function () {
                self.showSuccessMessage();
                self.hide();
            },
            error: function (model, error) {
                self.showErrorMessage();
                app.logger.error('Record failed to close. ' + error);
                self.model.revertAttributes();
            }
        });
    },

    _render: function () {
        var status = this.model.get('status');
        if (status == 'Held' || status == 'Not Held') {
            this.hide();
        } else {
            this._super('_render');
        }
    },

    showSuccessMessage: function () {
        app.alert.show('status_change_success', {
            level: 'success',
            autoClose: true,
            messages: app.lang.get('LBL_CHECK_COMPLETE_TASK', this.module)
        });
    },

    showErrorMessage: function () {
        app.alert.show('close_record_error', {
            level: 'error',
            title: app.lang.get('ERR_AJAX_LOAD')
        });
    }
})
