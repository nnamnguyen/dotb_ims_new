
({
    extendsFrom: 'ListView',

    /**
     * @inheritdoc
     *
     * Add KBContent plugin for view.
     * Create filter defs for current collection.
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], [
            'KBContent'
        ]);

        this._super('initialize', [options]);

        if (this.collection) {
            this.collection.filterDef = _.extend(
                [],
                this.context.get('collection').origFilterDef,
                this.context.get('filterDef')
            );
        }
    }

})
