
({
    events:{
        'change [name="receipt_number_1"]':'allocationAmount',
        'change [name="receipt_number_2"]':'allocationAmount',
        'change [name="receipt_number_3"]':'allocationAmount',

        'change [name="receipt_date_1"]':'allocationAmount',
        'change [name="receipt_date_2"]':'allocationAmount',
        'change [name="receipt_date_3"]':'allocationAmount',
    },
    renderFields:undefined,
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
        this.addFieldToRender(0);
        this.model.on('change:number_of_payment', this.changeReceipt, this);
        this.model.on('change:total', this.allocationAmount, this);

    },
    _render: function() {
        this._super('_render');
    },

    addFieldToRender:function (number) {
        if(this.context.get('layout') === "create") {
            this.renderFields = [];
            for (var i = 0; i < number; i++) {
                var no = i + 1;
                this.renderFields.push({
                    'type': 'fieldset',
                    'label': '',
                    'no': no,
                    'show_child_labels': true,
                    'sortable': false,
                    'fields': [
                        {
                            type: 'currency',
                            label: 'LBL_RECEIPT_AMOUNT',
                            tooltip: 'LBL_RECEIPT_AMOUNT',
                            name: 'receipt_number_' + no,
                            required: true,
                            default: 'now',
                            css_class: 'hello'
                        },
                        {
                            type: 'jdate',
                            label: 'LBL_RECEIPT_DATE',
                            tooltip: 'LBL_RECEIPT_DATE',
                            name: 'receipt_date_' + no,
                            required: true,
                            default: 'now',
                            css_class: 'hello'
                        }
                    ]
                })
            }
            this._render();
        }
    },
    changeReceipt:function (evt) {
        if(this.context.get('layout') === "create") {
            if (evt.get('number_of_payment') !== 'Monthly-plan' && evt.get('number_of_payment') !== '1') {
                this.addFieldToRender(evt.get('number_of_payment'));
            } else
                this.addFieldToRender(0);
            this.model.set({
                'receipt_number_1': 0,
                'receipt_number_2': 0,
                'receipt_number_3': 0,

            })
        }
    },

    allocationAmount:function (evt) {
        if(this.context.get('layout') === "create") {
            var list = {};
            var list_receipt = [];
            list_receipt[1] = this.model.get('receipt_number_1') === undefined ? 0 : Number(this.model.get('receipt_number_1'));
            list_receipt[2] = this.model.get('receipt_number_1') === undefined ? 0 : Number(this.model.get('receipt_number_2'));
            list_receipt[3] = this.model.get('receipt_number_1') === undefined ? 0 : Number(this.model.get('receipt_number_3'));
            var total = Number(this.model.get('total'));
            var split = Number(this.model.get('number_of_payment'));

            for (var i = 1; i < split; i++) {
                if (list_receipt[i] >= total) {
                    list_receipt[i] = total;
                    list_receipt[i + 1] = 0;
                    break;
                } else {
                    total = total - list_receipt[i];
                    if (i === split - 1) {
                        list_receipt[split] = total;
                    }
                }
            }
            list['receipt_number_1'] = {};
            list['receipt_number_2'] = {};
            list['receipt_number_3'] = {};

            list['receipt_number_1']['amount'] = list_receipt[1];
            list['receipt_number_2']['amount'] = list_receipt[2];
            list['receipt_number_3']['amount'] = list_receipt[3];

            list['receipt_number_1']['date'] = this.model.get('receipt_date_1');
            list['receipt_number_2']['date'] = this.model.get('receipt_date_2');
            list['receipt_number_3']['date'] = this.model.get('receipt_date_3');

            this.model.set({
                'receipt_number_1': list_receipt[1],
                'receipt_number_2': list_receipt[2],
                'receipt_number_3': list_receipt[3],
                'list_receipt': JSON.stringify(list)
            });
        }
    }

})
