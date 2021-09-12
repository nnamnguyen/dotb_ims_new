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
            window.open('index.php?module=Quotes&type=student&action=invoiceVoucher&record=' + this.model.id + '&dotb_body_only=true', '_blank');
            confirmExportPopup.destroy(document.body);
        }
    },

    bindDataChange: function () {
        if (this.model) {
            this.model.on("change", this.render, this);
        }
    }
})
