
({
    extendsFrom: 'RecordView',

    delegateButtonEvents: function() {
        this.context.on('button:export_button:click', this.exportListMembers, this);
        this._super("delegateButtonEvents");
    },

    /**
     * Event to trigger the Export page level action
     */
    exportListMembers: function() {
        app.alert.show('export_loading', {level: 'process', title: app.lang.get('LBL_LOADING')});
        app.api.exportRecords(
            {
                module: this.module,
                uid: [this.model.id],
                members: true
            },
            this.$el,
            {
                complete: function() {
                    app.alert.dismiss('export_loading');
                }
            }
        );
    }
})
