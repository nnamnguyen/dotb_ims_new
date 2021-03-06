
({
    extendsFrom: 'HeaderpaneView',

    events: {
        'click [name=save_button]:not(".disabled")': 'initiateSave',
        'click [name=cancel_button]': 'initiateCancel'
    },

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super("initialize", [options]);
        this.context.on('lead:convert-save:toggle', this.toggleSaveButton, this);
    },

    /**
     * @override
     *
     * Grabs the lead's name and format the title such as `Convert: <name>`.
     */
    _formatTitle: function(title) {
        var leadsModel = this.context.get('leadsModel'),
            name = !_.isUndefined(leadsModel.get('name')) ?
                leadsModel.get('name') :
                leadsModel.get('first_name') + ' ' + leadsModel.get('last_name');
        return app.lang.get(title, this.module) + ': ' + name;
    },

    /**
     * When finish button is clicked, send this event down to the convert layout to wrap up
     */
    initiateSave: function() {
        this.context.trigger('lead:convert:save');
    },

    /**
     * When cancel clicked, hide the drawer
     */
    initiateCancel : function() {
        app.drawer.close();
    },

    /**
     * Enable/disable the Save button
     *
     * @param enable true to enable, false to disable
     */
    toggleSaveButton: function(enable) {
        this.$('[name=save_button]').toggleClass('disabled', !enable);
    }
})
