
/**
 * @class View.Fields.Base.RevenueLineItems.BadgeField
 * @alias DOTB.App.view.fields.BaseRevenueLineItemsBadgeField
 * @extends View.Fields.Base.RowactionField
 */
({
    /**
     * @inheritdoc
     */
    extendsFrom: 'RowactionField',

    /**
     * @inheritdoc
     */
    showNoData: false,

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        this.model.on('change:' + this.name, this.render, this);
    }
});
