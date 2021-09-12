
({
    extendsFrom: 'FieldsetField',
    events:{
        'click .choose_discount_amount':'chooseDiscount',
        'click .choose_sponsor_amount':'chooseSponsor',
        'click .choose_loyalty_amount':'chooseLoyalty',
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
        this.model.on('change:new_sub',this.resetDiscount,this);
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
                        product_discount:'quote',
                    }
                },
                function (data) {
                    if (data != null) {
                        var detail = [];
                        var amount = 0;
                        var percent = 0;
                        var total_discount = 0;
                        var total = Number(seft.model.get('new_sub'));
                        data.forEach(function (item) {
                            let select = {};
                            select['id'] = item.id;
                            select['name'] = item.name;
                            select['amount'] = item.discount_amount;
                            select['percent'] = item.discount_percent==null?0:item.discount_percent;
                            select['total'] = select['percent']==0?item.discount_amount:(total*item.discount_percent)/100;
                            detail.push(select);
                            amount += Number(item.discount_amount);
                            percent += Number(item.discount_percent);
                        });
                        total_discount = ((total - amount) * (percent/100)) + amount;

                        seft.model.set({
                            'order_discount_percent': app.utils.formatNumber((total_discount / total) * 100, 0, 2),
                            'order_discount_amount': total_discount,
                            'discount_detail': detail,
                        });
                        seft._render();
                    }
                })
        }
    },

    chooseSponsor:function (evt) {
        if(location.hash.indexOf('edit')!= -1 || location.hash.indexOf('create') != -1) {
            var seft = this;
            app.drawer.open({
                    layout: 'selection-list',
                    context: {
                        module: 'J_Voucher',
                    }
                },
                function (data) {
                    if (data != null) {
                        var total = Number(seft.model.get('new_sub'));
                        var detail = [];
                        let select = {};
                        select['id'] = data.id;
                        select['name'] = data.name;
                        select['description'] = data.description;
                        select['foc_type'] = data.foc_type;
                        select['amount'] = data.discount_amount;
                        select['percent'] = data.discount_percent==null?0:data.discount_percent;
                        select['total'] = select['percent']==0?data.discount_amount:(total*data.discount_percent)/100;
                        detail.push(select);
                        var amount = data.discount_amount + (data.discount_percent * total) / 100;
                        var percent = app.utils.formatNumber(data.discount_percent + (data.discount_amount / total) * 100, 0, 2);
                        if(amount > Number(seft.model.get('total'))) {
                            amount = total;
                        }
                        seft.model.set({
                            'order_sponsor_percent': percent,
                            'order_sponsor_amount': amount,
                            'sponsor_detail': detail,
                        });
                        seft._render();
                    }
                })
        }
    },
    chooseLoyalty:function (evt) {
        if(location.hash.indexOf('edit')!= -1 || location.hash.indexOf('create') != -1) {
            if (this.model.get('parent_id') == undefined || this.model.get('parent_id') == null) {
                app.alert.show('message-id', {
                    level: 'info',
                    messages: app.lang.get('LBL_CHOOSE_STUDENT', 'Quotes'),
                    autoClose: true
                });
                return;
            }
            if (this.model.get('loyalty') == undefined) {
                window.seft = this;
                app.api.call("create", App.api.buildURL('get/loyalty'), {id: this.model.get('parent_id'),quote_id:this.model.get('id')}, {
                    success: function (data) {
                        window.seft.model.set({
                            'loyalty': data.data.loyalty,
                            'loyalty_rate': data.data.loyalty_rate,
                            'accrual_rate': data.data.accrual_rate,
                        });
                        if (Modernizr.touch) {
                            app.$contentEl.addClass('content-overflow-visible');
                        }
                        var choiceLoyaltyView = window.seft.view.layout.getComponent('choice-loyalty');
                        if (!choiceLoyaltyView) {
                            var context = window.seft.context.getChildContext({
                                module: 'J_Loyalty',
                                forceNew: true,
                            });
                            context.prepare();
                            choiceLoyaltyView = app.view.createView({
                                context: context,
                                name: 'choice-loyalty',
                                layout: window.seft.view.layout,
                                module: context.module,
                            });
                            window.seft.view.layout._components.push(choiceLoyaltyView);
                            window.seft.view.layout.$el.append(choiceLoyaltyView.$el);
                        }
                        window.seft.view.layout.trigger("app:view:choice-loyalty");
                        window.self = undefined;
                    },
                    error: function (data) {
                    },
                });
            } else {
                if (Modernizr.touch) {
                    app.$contentEl.addClass('content-overflow-visible');
                }
                var choiceLoyaltyView = this.view.layout.getComponent('choice-loyalty');
                if (!choiceLoyaltyView) {
                    var context = this.context.getChildContext({
                        module: 'J_Loyalty',
                        forceNew: true,
                    });
                    context.prepare();
                    choiceLoyaltyView = app.view.createView({
                        context: context,
                        name: 'choice-loyalty',
                        layout: this.view.layout,
                        module: context.module,
                    });
                    this.view.layout._components.push(choiceLoyaltyView);
                    this.view.layout.$el.append(choiceLoyaltyView.$el);
                }
                this.view.layout.trigger("app:view:choice-loyalty");
            }
        }

    },
    resetDiscount:function () {
        if(location.hash.indexOf('edit') != -1 || location.hash.indexOf('create') != -1) {
            this._calculateDiscount(this.model.get('discount_detail'));
            this._calculateLoyalty(this.model.get('loyalty_detail'));
        }
    },

    _calculateDiscount(data){
        var detail = [];
        var amount = 0;
        var percent = 0;
        var total_discount = 0;
        var total = Number(this.model.get('new_sub'));
        if(data != "0") {
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
                'order_discount_percent': app.utils.formatNumber((total_discount / total) * 100, 0, 2),
                'order_discount_amount': total_discount,
                'discount_detail': detail,
            });
        }
    },

    _calculateSponsor(data){
        var total = Number(this.model.get('new_sub'));
        var detail = [];
        let select = {};
        select['id'] = data.id;
        select['name'] = data.name;
        select['description'] = data.description;
        select['foc_type'] = data.foc_type;
        select['amount'] = data.percent;
        select['percent'] = data.percent==null?0:data.percent;
        select['total'] = select['percent']==0?data.amount:(total*data.amount)/100;
        detail.push(select);
        var amount = data.amount + (data.percent * total) / 100;
        var percent = app.utils.formatNumber(data.percent + (data.amount / total) * 100, 0, 2);
        if(amount > Number(this.model.get('total'))) {
            amount = total;
        }
        this.model.set({
            'order_sponsor_percent': percent,
            'order_sponsor_amount': amount,
            'sponsor_detail': detail,
        });
    },

    _calculateLoyalty(data){
        var total = Number(this.model.get('new_sub'));
        var percent = 0;
        if(data != undefined) {
            data.forEach(function (item) {
                item.loyalty_percent = (item.loyalty_amount / total) * 100;
                percent = item.loyalty_percent;
            })

            this.model.set({
                'order_loyalty_amount': data[0].loyalty_amount,
                'order_loyalty_percent': percent,
                'loyalty_detail': data,
            });
        }
    }
})
