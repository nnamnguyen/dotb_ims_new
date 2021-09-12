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
        if (this.model.get('status') === 'Unpaid') {
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
        app.drawer.open({
            layout: 'record',
            context: {
                module: this.module,
                modelId: this.model.id,
                action: 'edit',
            }
        },function () {
            // seft.context.parent.trigger('subpanel:reload', {links: ['quote_paymentdetails','j_paymentdetail']});
            app.router.refresh();
        });
    },

    bindDataChange: function () {
        if (this.model) {
            this.model.on("change", this.render, this);
        }
    }
})
