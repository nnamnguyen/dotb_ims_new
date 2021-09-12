/**
 * @class View.Fields.Base.Leads.ConvertbuttonField
 * @alias DOTB.App.view.fields.BaseLeadsConvertbuttonField
 * @extends View.Fields.Base.RowactionField
 */
({
    extendsFrom: 'RowactionField',

    initialize: function (options) {
        this._super("initialize", [options]);
        this.type = 'rowaction';
    },

    _render: function () {
        if (this.model.get('status') === 'Paid') {
            this._super("_render");
        } else {
            this.hide();
            return false;
        }
    },

    /**
     * Event to trigger the convert lead process for the lead
     */
    rowActionSelect: function () {
        if(this.model.attributes.status === 'Cancelled'){
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
                    self.voidReceipt(self.model);
                },
                onCancel: function () {
                }
            });
        }
    },

    bindDataChange: function () {
        if (this.model) {
            this.model.on("change", this.render, this);
        }
    },

    voidReceipt:function (model) {
        var seft = this;
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
                    if(app.controller.context.get('module') == 'Quotes')
                        app.router.refresh();
                    else{
                        seft.context.parent.trigger('subpanel:reload', {links: ['paymentdetail_parent','j_paymentdetail']});
                        seft.context.parent.trigger('subpanel:reload', {links: ['quote_parent','quotes']});
                    }
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
