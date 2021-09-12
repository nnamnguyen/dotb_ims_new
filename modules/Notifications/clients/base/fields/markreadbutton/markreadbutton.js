({
    extendsFrom: 'RowactionField',
    initialize: function (options) {
        this.events = _.extend({}, this.events, options.def.events, {
            'click [name="record-is-read"]': 'markReadButtonClicked'
        });
        this._super('initialize', [options]);
        this.type = 'rowaction';
    },
    _render: function () {
        if (this.model.get('is_read')) {
            this.hide();
        } else {
            this._super('_render');
        }
    },
    markReadButtonClicked: function () {
        if (this.model.get('is_read')) {
            return;
        }
        var self=this;
        this.model.save({is_read: 1}, {
            success: function () {
                self._render();

                //add by TKT
                var num = $('[data-name="notifications-list-button"] .badge').text();
                num = parseInt(num,10);
                num--;
                $('[data-name="notifications-list-button"] .badge').text(num);
            },
            error: _.bind(function (error) {
                self.showErrorMessage();
                app.logger.error('Record failed to close. ' + error);
                self.model.revertAttributes();
            }, this)
        });
    },

    showErrorMessage: function () {
        app.alert.show('close_record_error', {
            level: 'error',
            title: app.lang.get('ERR_AJAX_LOAD')
        });
    },
    bindDataChange: function () {
        if (this.model) {
            this.model.on('change:is_read', this._render, this);
        }
    }
})
