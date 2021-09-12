
({
    extendsFrom: "RowactionField",

    contextEvents: {
        "list:voidInvoice:fire":"warnVoidReceipt",
    },

    events:{
        'click [name="void"]': 'warnVoidReceipt',
    },
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.clone(this.plugins) || [];
        this.plugins.push('DisableDelete');
        this._super("initialize", [options]);
    },

    warnVoidReceipt:function (model) {
        if(this.model.get('status') == 'Cancelled'){
            app.alert.show('message-id', {
                level: 'info',
                messages: app.lang.get('LBL_MESSAGE_ACTION_RECEIPT','J_PaymentDetail'),
                autoClose: true
            });
        }
        else {
            var self = this;
            app.alert.show('void_receipt', {
                level: 'confirmation',
                messages: app.lang.getAppString('NTC_VOID_RECEIPT_CONFIRMATION_FORMATTED'),
                onConfirm: function () {
                    self.voidReceipt(self.model.attributes);
                },
                onCancel: function () {
                }
            });
        }
    },
    voidReceipt:function (model) {
        app.alert.show('message-id', {
            level: 'process',
            title: 'In Process...'
        });
        app.api.call("update", App.api.buildURL('receipt/void'), {id:model.id}, {
            success: function (data) {
                if(data.success == 1) {
                    app.alert.show('message-id', {
                        level: 'success',
                        messages: 'Successfull',
                        autoClose: true
                    });
                    location.reload(true);
                }
                else{
                    app.alert.dismiss('message-id');
                    app.alert.show('info-id', {
                        level: 'info',
                        messages: data.notification,
                        autoClose: true
                    });
                }
            },
            error:function (data) {
                app.alert.dismiss('alert-id');
            }
        });
    },
})
