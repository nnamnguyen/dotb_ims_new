
/**
 * @class View.Fields.Base.Quotes.CurrencyField
 * @alias DOTB.App.view.fields.BaseQuotesCurrencyField
 * @extends View.Fields.Base.CurrencyField
 */
({
    extendsFrom: 'CurrencyField',

    /**
     * The field's value in Percent
     */
    valuePercent: undefined,

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        this._super('bindDataChange');

        if (this.name === 'deal_tot' && this.view.name === 'quote-data-grand-totals-header') {
            this.model.on('change:deal_tot_discount_percentage', function() {
                this._updateDiscountPercent();
            }, this);

            if (this.context.get('create')) {
                // if this is deal_tot and on the create view, update the discount percent
                this._updateDiscountPercent();
            }
        }
    },

    /**
     * Needed to override loadTemplate to check field permissions for Quotes header and footer views
     *
     * @inheritdoc
     */
    _loadTemplate: function() {
        var viewName = this.view.name;
        if ((viewName === 'quote-data-grand-totals-header' || viewName === 'quote-data-grand-totals-footer') &&
            !this._checkAccessToAction('list')) {
            // set the action to noaccess so the field template will get the right class
            this.action = 'noaccess';
            // if this is a header or footer currency field and there's no access, show noaccess
            this.tplName = 'noaccess-' + viewName;
            this.template = app.template.getField('currency', this.tplName, this.module);
        } else {
            this._super('_loadTemplate');
        }
    },

    /**
     * Updates `this.valuePercent` for the deal_tot field in the quote-data-grand-totals-header view.
     *
     * @private
     */
    _updateDiscountPercent: function() {
        var percent = this.model.get('deal_tot_discount_percentage');

        if (!_.isUndefined(percent)) {
            //clean up precision
            percent = app.utils.formatNumber(
                percent,
                false,
                2,
                app.user.getPreference('number_grouping_separator'),
                app.user.getPreference('decimal_separator')
            );

            if (app.lang.direction === 'rtl') {
                this.valuePercent = '%' + percent;
            } else {
                this.valuePercent =  percent + '%';
            }

            // re-render after update
            this.render();
        }
    }
});
