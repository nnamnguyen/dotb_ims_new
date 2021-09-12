
({
    extendsFrom: 'PanelTopView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['MassQuote']);
        this._super('initialize', [options]);
    },

    /**
     * Overriding to create a Quote from a Subpanel using the Quotes create view not a drawer
     *
     * @inheritdoc
     */
    createRelatedClicked: function(event) {
        var massCollection = this.context.get('mass_collection');
        var module = this.context.parent.get('module');
        if (!massCollection) {
            massCollection = this.context.get('collection').clone();
            if (!_.contains(['Accounts', 'Opportunities', 'Contacts'], module)) {
                massCollection.fromSubpanel = true;
            }
            this.context.set('mass_collection', massCollection);
        }
        this.layout.trigger('list:massquote:fire');
    }
})
