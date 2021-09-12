
({
    extendsFrom: 'RecordlistView',

    /**
     * Removes the event listeners that were added to the mass collection.
     */
    unbindData: function() {
        var massCollection = this.context.get('mass_collection');
        if (massCollection) {
            massCollection.off(null, null, this);
        }
        this._super("unbindData");
    },

    /**
     * @inheritdoc
     */
    _setOrderBy: function(options) {
        this.context.set('sortOptions', options);
        options.query = this.context.get('query');
        options.module_list = this.context.get('module_list');
        options.offset = 0;
        options.update = false;
        this._super('_setOrderBy', options);
    },

    /**
     * Override to hook in additional triggers as the mass collection is updated (rows are checked on/off in
     * the actionmenu field). Also attempts to pre-check any rows when the list is refreshed and selected recipients
     * are found within the new result set (this behavior occurs when the user searches the address book).
     *
     * @private
     */
    _render: function() {
        if (app.acl.hasAccessToAny('developer')) {
            this._super('_render');
        }
        else {
            app.controller.loadView({
                layout: 'access-denied'
            });
        }
    },

    /**
     * @inheritdoc
     */
    _dispose: function() {
        jQuery('.adam-modal').remove();
        this._super('_dispose');
    }
})
