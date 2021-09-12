
({
    extendsFrom: 'FieldsetField',
    events:{
        'click #search_sponsor_code':'checkSponsor',
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
        this.model.on('click:#search_sponsor_code',this.checkSponsor,this);
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

    resetDiscount:function () {
        if(location.hash.indexOf('edit') != -1 || location.hash.indexOf('create') != -1) {
            this._calculateSponsor(this.model.get('sponsor_detail')[0]);
        }
    },
    checkSponsor:function () {
        var seft = this;
        var code = $('[name="sponsor_code"]').val();
        app.api.call("create", App.api.buildURL('check/sponsor'), {code: code,team_id:this.model.get('team_name')[0].id}, {
            success: function (data) {
                if(data.success == 0)
                {
                    $.alert(app.lang.get('LBL_SPONSOR_NOT_FOUND','Quotes'));
                }
                else{
                    var discount_amount = '<br>Discount: '+Number(data.discount_amount,0,0,',','.');
                    var discount_percent= '<br>Discount %: '+Number(data.discount_percent,0,2,',','.');
                    if(data.discount_amount == 0) discount_amount = '';
                    if(data.discount_percent == 0) discount_percent = '';
                    $.confirm({
                        title: app.lang.get('LBL_CONFIRM','Quotes'),
                        content: 'Sponsor: '+ data.sponsor_number  + data.status_color+'<br>Expires: ' + data.end_date + discount_amount + discount_percent + '<br>Total Redemption: '+ data.used_time,
                        buttons: {
                            "Use": {
                                btnClass: 'btn-blue',
                                action: function(){
                                    if(data.status != 'Activated') {
                                        app.alert.show('message-id', {
                                            level: 'info',
                                            messages: app.lang.get('LBL_CAN_USE_SPONSOR','Quotes'),
                                            autoClose: true
                                        });
                                    }
                                    else{
                                        var total = Number(seft.model.get('new_sub'));
                                        data.discount_amount = Number(data.discount_amount);
                                        data.discount_percent = Number(data.discount_percent);
                                        var detail = [];
                                        let select = {};
                                        select['id'] = data.id;
                                        select['name'] = data.sponsor_number;
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
                                        seft.resetDiscount()
                                    }
                                }
                            },
                            "Cancel": {
                                action: function(){

                                }
                            },
                        }
                    });
                }
            },
            error: function (data) {
            },
        });
    },
    _calculateSponsor(data){
        if(data != 0) {
            var total = Number(this.model.get('new_sub'));
            var detail = [];
            let select = {};
            select['id'] = data.id;
            select['name'] = data.name;
            select['description'] = data.description;
            select['foc_type'] = data.foc_type;
            select['amount'] = data.amount;
            select['percent'] = data.percent == null ? 0 : data.percent;
            select['total'] = select['percent'] == 0 ? data.amount : (total * data.amount) / 100;
            detail.push(select);
            var amount = data.amount + (data.percent * total) / 100;
            var percent = app.utils.formatNumber(data.percent + (data.amount / total) * 100, 0, 2);
            if (amount > Number(this.model.get('total'))) {
                amount = total;
            }
            this.model.set({
                'order_sponsor_percent': percent,
                'order_sponsor_amount': amount,
                'sponsor_detail': detail,
            });
            $('[name="sponsor_code"]').val(data.name);
        }
    },

})
