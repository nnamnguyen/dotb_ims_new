
/**
 * @class View.Views.Base.AuditHeaderpaneView
 * @alias DOTB.App.view.views.BaseAuditHeaderpaneView
 * @extends View.Views.Base.HeaderpaneView
 */
({
    extendsFrom: 'HeaderpaneView',

    events: {
        'click a[name=close_button]': 'close'
    },

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        //shortcut keys
        app.shortcuts.register({
            id: 'AuditHeaderPanel:Close',
            keys: ['esc','mod+alt+l'],
            component: this,
            description: 'LBL_SHORTCUT_CLOSE_DRAWER',
            callOnFocus: true,
            handler: function() {
                var $closeButton = this.$('a[name=close_button]');
                if ($closeButton.is(':visible') && !$closeButton.hasClass('disabled')) {
                    $closeButton.click();
                }
            }
        });
    },

    /**
     * Closes the drawer.
     */
    close: function() {
        app.drawer.close();
    },

    /**
     * @override
     *
     * Overriding to show record name on title header if it is available;
     * if not, use the standard title.
     */
    _formatTitle: function(title) {
        var model = this.context.get('model');
        var recordName = app.utils.getRecordName(model);
        if (recordName) {
            return app.lang.get('TPL_AUDIT_LOG_TITLE', model.module, {name: recordName});
        } else if (title) {
            return app.lang.get(title, this.module);
        } else {
            return '';
        }
    }
})
