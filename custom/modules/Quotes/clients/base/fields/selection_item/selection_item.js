
({
    events:{
        'click .list_balance':'chooseBalance',
    },

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
    },

    /**
     * @inheritdoc
     */

    _render: function(){
         this._super('_render');
        $('input.select2[name=billing_contact_name]').trigger('change');
    },
    chooseBalance: function (evt) {
        var data = [];
        var total_amount=0;
        $('.list_balance').each(function (checkbox) {
            if(this.checked) {
                data.push(this.dataset.value);
                total_amount = Number(total_amount) + Number(this.dataset.money);
            }
        })
        if(total_amount >= this.model.get('new_sub'))
            total_amount = Number(this.model.get('new_sub'));
        $('[name="hidden_use_free_balance"]').val(total_amount);
        $('[name="hidden_use_free_balance"]').trigger('change');
        $('#list_balance').val(data);
        $('#list_balance').trigger('change');


    }

})
