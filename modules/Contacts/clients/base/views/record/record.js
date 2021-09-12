

({
    extendsFrom: 'RecordView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['HistoricalSummary']);
        this.plugins.push('ContactsPortalMetadataFilter');
        this._super('initialize', [options]);
        this.removePortalFieldsIfPortalNotActive(this.meta);
    }
})
