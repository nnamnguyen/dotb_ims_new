
({
    extendsFrom: 'FieldsetField',
    events:{
        'click .product_discount':'chooseDiscount',
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
        this.model.on('change:total_amount',this.resetDiscount,this);
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

    chooseDiscount:function (evt) {
        if(location.hash.indexOf('edit')!= -1 || location.hash.indexOf('create') != -1) {
            var seft = this;
            app.drawer.open({
                    layout: 'quote-discount',
                    context: {
                        module: 'J_Discount',
                        isMultiSelect: true,
                        total_amount: this.model.get('subtotal'),
                        discount_detail:this.model.get('discount_detail')==undefined?'':this.model.get('discount_detail'),
                        product_discount: this.model.get('product_discount'),
                    }
                },
                function (data) {
                    if (data != null) {
                        var description = 'Sử dụng giảm giá';
                        var detail = [];
                        var amount = 0;
                        var percent = 0;
                        var total_discount = 0;
                        var total = Number(seft.model.get('subtotal'));
                        data.forEach(function (item) {
                            let select = {};
                            select['id'] = item.id;
                            select['name'] = item.name;
                            select['amount'] = item.discount_amount;
                            select['percent'] = item.discount_percent==null?0:item.discount_percent;
                            select['total'] = select['percent']==0?item.discount_amount:total*item.discount_percent;
                            detail.push(select);
                            amount += Number(item.discount_amount);
                            percent += Number(item.discount_percent);
                            description =description +' + '+item.name;
                        });
                        total_discount = ((total - amount) * (percent/100)) + amount;
                        seft.model.set({
                            'discount_percent': app.utils.formatNumber((total_discount / total) * 100, 0, 2),
                            'discount_amount': total_discount,
                            'discount_detail': detail,
                        });

                        seft.model.attributes.discount_percent= app.utils.formatNumber((total_discount / total) * 100, 0, 2);
                        seft.model.attributes.discount_amount = total_discount;
                        seft.model.attributes.discount_detail = detail;
                        seft._render();
                    }
                })
        }
    },
    resetDiscount:function () {
        if(location.hash.indexOf('edit') != -1 || location.hash.indexOf('create') != -1) {
            this._calculateDiscount(this.model.get('discount_detail'));
        }
    },

    _calculateDiscount(data){
        var detail = [];
        var amount = 0;
        var percent = 0;
        var total_discount = 0;
        var total = Number(this.model.get('subtotal'));
        debugger;
        if(data != "0" && data != undefined &&data != "null") {
            data.forEach(function (item) {
                let select = {};
                select['id'] = item.id;
                select['name'] = item.name;
                select['amount'] = item.amount;
                select['percent'] = item.percent == null ? 0 : item.percent;
                select['total'] = select['percent'] == 0 ? item.percent : (total * item.percent) / 100;
                detail.push(select);
                amount += Number(item.amount);
                percent += Number(item.percent);
            });
            total_discount = ((total - amount) * (percent / 100)) + amount;

            this.model.set({
                'discount_percent': app.utils.formatNumber((total_discount / total) * 100, 0, 2),
                'discount_amount': total_discount,
                'discount_detail': detail,
            });
            this._render();
        }
    },

})

