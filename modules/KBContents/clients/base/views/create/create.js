

({
    extendsFrom: 'CreateView',

    /**
     * @inheritdoc
     *
     * Add KBContent plugin for view.
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], [
            'KBContent',
            'KBNotify'
        ]);
        this._super('initialize', [options]);
    },

    /**
     * Using the model returned from the API call, build the success message.
     * @param {Data.Bean} model KBContents bean for record that was just created.
     * @return {string} The success message.
     */
    buildSuccessMessage: function(model) {
        var message = this._super('buildSuccessMessage', [model]);

        // If user has no access to view record - don't show record link for him
        if (!app.acl.hasAccessToModel('view', this.model)) {
            message = message.replace(/<\/?a[^>]+>/g, '');
        }

        return message;
    },

    /**
     * Overriding custom save options to trigger kb:collection:updated event when KB model saved.
     *
     * @override
     * @param {Object} options
     */
    getCustomSaveOptions: function(options) {
        var success = _.compose(options.success, _.bind(function(model) {
            this.notifyAll('kb:collection:updated', model);
            return model;
        }, this));
        return {'success': success};
    }
})
