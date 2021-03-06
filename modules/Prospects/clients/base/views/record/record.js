
({
    extendsFrom: 'RecordView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['HistoricalSummary']);
        this._super('initialize', [options]);
    },

    delegateButtonEvents: function() {
        this.context.on('button:convert_button:click', this.convertProspectClicked, this);
        this._super('delegateButtonEvents');
    },

    convertProspectClicked: function() {
        var prefill = app.data.createBean('Leads');

        prefill.copy(this.model);
        app.drawer.open({
            layout: 'create',
            context: {
                create: true,
                model: prefill,
                module: 'Leads',
                prospect_id: this.model.get('id')
            }
        }, _.bind(function(context, model) {
            //if lead is created, grab the new relationship to the target so the convert-results will refresh
            if (model && model.id && !this.disposed) {
                this.model.fetch();
                _.each(this.context.children, function(child) {
                    if (child.get('isSubpanel') && !child.get('hidden')) {
                        if (child.get('collapsed')) {
                            child.resetLoadFlag({recursive: false});
                        } else {
                            child.reloadData({recursive: false});
                        }
                    }
                });
            }
        }, this));

        prefill.trigger('duplicate:field', this.model);
    }
})
