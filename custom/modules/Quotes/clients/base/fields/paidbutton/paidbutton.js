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
        if (this.model.get('status') !== 'Completed' && this.model.get('quote_stage') =='Closed won' ) {
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
        var seft = this;
        var model = app.data.createBean('J_PaymentDetail');
        model.set({
            'quote_id': this.model.get('id'),
            'quote_name': this.model.get('name'),
            'parent_id': this.parent.model.get('parent_id'),
            'parent_name': this.parent.model.get('parent_name'),
            'payment_amount': this.model.get('unpaid_amount'),
            'payment_type': 'Normal',
        });
        app.drawer.open({
            layout: 'create',
            context: {
                module: 'J_PaymentDetail',
                create: true,
                model:model,
            }
        },function () {
            seft.context.parent.trigger('subpanel:reload', {links: ['quote_parent','quotes']});
            seft.context.parent.trigger('subpanel:reload', {links: ['paymentdetail_parent','j_paymentdetail']});
            // app.router.refresh();
        });
    },

    bindDataChange: function () {
        if (this.model) {
            this.model.on("change", this.render, this);
        }
    }
})
