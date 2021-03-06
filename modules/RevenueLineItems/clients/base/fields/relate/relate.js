

/**
 * @class View.Fields.Base.RevenueLineItems.RelateField
 * @alias DOTB.App.view.fields.BaseRevenueLineItemsRelateField
 * @extends View.Fields.Base.RelateField
 */
({
    extendsFrom: 'BaseRelateField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        // deleting for RLI create when there is no account_id.
        if (options && options.def.filter_relate && !options.model.has('account_id')) {
            delete options.def.filter_relate;
        }

        this._super('initialize', [options]);
    },

    setValue: function(models) {
        if (!models) {
            return;
        }
        var userCurrency = app.user.getCurrency();
        var createInPreferred = userCurrency.currency_create_in_preferred;
        var currencyFields;
        var currencyFromRate;

        if (this.name === 'product_template_name' && createInPreferred) {
            // get any currency fields on the model
            currencyFields = _.filter(this.model.fields, function(field) {
                return field.type === 'currency';
            });
            currencyFromRate = models.base_rate;
            models.currency_id = userCurrency.currency_id;
            models.base_rate = userCurrency.currency_rate;

            _.each(currencyFields, function(field) {
                // if the field exists on the model, convert the value to the new rate
                if (models[field.name] && field.name.indexOf('_usdollar') === -1) {
                    models[field.name] = app.currency.convertWithRate(
                        models[field.name],
                        currencyFromRate,
                        userCurrency.currency_rate
                    );
                }
            }, this);
        }
        this._super('setValue', [models]);
    }
})
