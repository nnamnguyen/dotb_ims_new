
({
    extendsFrom: 'RecordView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['HistoricalSummary']);
        this._super('initialize', [options]);
    },

    /**
     * Remove id, status and converted fields
     * (including associations created during conversion) when duplicating a Lead
     * @param prefill
     */
    setupDuplicateFields: function(prefill){
        var duplicateBlackList = ['id', 'status', 'converted', 'account_id', 'opportunity_id', 'contact_id'];
        _.each(duplicateBlackList, function(field){
            if(field && prefill.has(field)){
                //set blacklist field to the default value if exists
                if (!_.isUndefined(prefill.fields[field]) && !_.isUndefined(prefill.fields[field].default)) {
                    prefill.set(field, prefill.fields[field].default);
                } else {
                    prefill.unset(field);
                }
            }
        });
    }
})
