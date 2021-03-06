
({
    extendsFrom: 'RecordlistView',

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

        this.layout.on('list:record:deleted', function() {
            this.refreshCollection();
            this.notifyAll('kb:collection:updated');
        }, this);

        this.context.on('kbcontents:category:deleted', function(node) {
            this.refreshCollection();
            this.notifyAll('kb:collection:updated');
        }, this);

        if (!app.acl.hasAccessToModel('edit', this.model)) {
            this.context.set('requiredFilter', 'records-noedit');
        }
    }
})
