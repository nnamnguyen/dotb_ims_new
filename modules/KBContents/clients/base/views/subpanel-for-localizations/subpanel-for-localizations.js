

({
    extendsFrom: 'SubpanelListView',

    /**
     * @inheritdoc
     */
    dataView: 'subpanel-for-localizations',

    /**
     * @inheritdoc
     *
     * Check access to model.
     * Setup dataView to load correct viewdefs from subpanel-for-localizations
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        if (!app.acl.hasAccessToModel('edit', this.model)) {
            this.context.set('requiredFilter', 'records-noedit');
        }
    },

    /**
     * @inheritdoc
     *
     * Removes 'status' field from options if there is no access to model.
     */
    parseFieldMetadata: function(options) {
        options = this._super('parseFieldMetadata', [options]);

        if (app.acl.hasAccess('edit', options.module)) {
            return options;
        }

        _.each(options.meta.panels, function(panel, panelIdx) {
            panel.fields = _.filter(panel.fields, function(field) {
                return field.name !== 'status';
            }, this);
        }, this);

        return options;
    }
})
