

/**
 * @class View.Fields.Base.RevenueLineItems.ConvertToQuoteField
 * @alias DOTB.App.view.fields.BaseRevenueLineItemsConvertToQuoteField
 * @extends View.Fields.Base.RowactionField
 */
({
    extendsFrom: 'RowactionField',

    /**
     * @inheritdoc
     *
     * @param {Object} options
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.type = 'rowaction';

        this.context.on('button:convert_to_quote:click', this.convertToQuote, this);
    },

    /**
     * @inheritdoc
     */
    bindDataChange: function() {
        this.model.on('sync', this._toggleDisable, this);
        this.model.on('change:quote_id', this._toggleDisable, this);
    },

    /**
     * convert RLI to quote
     * @param {Object} e
     */
    convertToQuote: function(e) {
        var massCollection = this.context.get('mass_collection');
        if (!massCollection) {
            massCollection = this.context.get('collection').clone();
            this.context.set('mass_collection', massCollection);
        }

        this.view.layout.trigger('list:massquote:fire');
    },

    /**
     * Reusable method for the event actions
     *
     * @private
     */
    _toggleDisable: function() {
        var quote_id = this.model.get('quote_id');
        this.setDisabled(!(_.isUndefined(quote_id) || _.isEmpty(quote_id)));
    }
})
