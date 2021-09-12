
({
    /**
     * @inheritdoc
     *
     * Some plugins use events which prevents {@link View.Field#delegateEvents}
     * to fallback to metadata defined events.
     * This will make sure we merge metadata events with the ones provided by
     * the plugins.
     *
     * The Base Field will always clear any tooltips after `render`.
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        var total_amount = this.context.get('total_amount');
        if(total_amount == undefined || total_amount == 'null')
            total_amount = this.context.parent.get('model').get('new_sub');

        this.model.set({
            'order_total_amount':total_amount
        })
    },

    /**
     * Calls {@link View.Fields.Base.RelateField#_render} and renders the select2
     * module dropdown.
     *
     * @inheritDoc
     */
    _render: function() {
        this._super("_render");
    },

})
