
/**
 * @class View.Views.Base.Currencies.PreviewHeaderView
 * @alias DOTB.App.view.views.BaseCurrenciesPreviewHeaderView
 * @extends View.Views.Base.PreviewHeaderView
 */
({
    extends: 'PreviewHeaderView',
    isBase: false,

    /**
     * @inheritdoc
     * @override
     */
    triggerEdit: function() {
        //If this isn't the base currency, go ahead and display the edit view
        if (!this.isBase) {
            this._super('triggerEdit');
        }
    },

    /**
     *
     * @inheritdoc
     * @override
     * @private
     */
    _delegateEvents: function() {
        this._super('_delegateEvents');
        app.events.on('list:preview:decorate', this.isBaseCurrency, this);
    },

    /**
     * Checks to see if the model is the base currency
     * @param model
     */
    isBaseCurrency: function(model) {
        if (model && _.isFunction(model.get) && model.get('id') === app.currency.getBaseCurrencyId()) {
            this.isBase = true;
        } else {
            this.isBase = false;
        }
    }
})
