/*
 * Your installation or use of this DotBCRM file is subject to the applicable
 * terms available at
 * http://support.dotbcrm.com/06_Customer_Center/10_Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this DotBCRM file.
 *
 * Copyright (C) DotBCRM Inc. All rights reserved.
 */
({
    'events': {
        'click': 'updateCss'
    },
    transactionValue: '',
    _currencyField: null,
    hideCurrencyDropdown: false,
    _lastCurrencyId: null,
    plugins: ['EllipsisInline', 'Tooltip'],
    direction: 'ltr',
    initialize: function(options) {
        this._super('initialize', [options]);
        var currencyField = this.def.currency_field || 'currency_id',
            currencyFieldValue, baseRateField, baseRateFieldValue;
        if (this.model.isNew() && (!this.model.isCopy())) {
            currencyFieldValue = app.user.getPreference('currency_id');
            this.model.set(currencyField, currencyFieldValue);
            baseRateField = this.def.base_rate_field || 'base_rate';
            baseRateFieldValue = app.metadata.getCurrency(currencyFieldValue).conversion_rate;
            this.model.set(baseRateField, baseRateFieldValue);
            if (_.isFunction(this.model.setDefault)) {
                var defaults = {};
                defaults[currencyField] = currencyFieldValue;
                defaults[baseRateField] = baseRateFieldValue;
                this.model.setDefault(defaults);
            }
        }
        this.hideCurrencyDropdown = this.view.action === 'list';
        this._lastCurrencyId = this.model.get(currencyField);
    },
    _render: function() {
        if (this._currencyField) {
            this._currencyField.dispose();
            this._currencyField = null;
        }
        app.view.Field.prototype._render.call(this);
        if (this.hideCurrencyDropdown === false && this.tplName === 'edit') {
            this.getCurrencyField().setElement(this.$('span[sfuuid="' + this.currencySfId + '"]'));
            this.$el.find('div.select2-container').css('min-width', '8px');
            this.getCurrencyField().render();
        }
        return this;
    },
    bindDataChange: function() {
        this.model.on('change:' + this.name, this._valueChangeHandler, this);
        if (this.def.is_base_currency) {
            return;
        }
        var currencyField = this.def.currency_field || 'currency_id';
        var baseRateField = this.def.base_rate_field || 'base_rate';
        this.model.on('change:' + baseRateField, function(model, baseRate, options) {
            var self = this;
            _.defer(function() {
                self.model.trigger('change:' + self.name, self.model, self.model.get(self.name));
            });
        }, this);
        this.model.on('change:' + currencyField, function(model, currencyId, options) {
            if (!currencyId || !this._lastCurrencyId) {
                this._lastCurrencyId = currencyId;
                return;
            }
            this.model.set(baseRateField, app.metadata.getCurrency(currencyId).conversion_rate, {
                silent: true
            });
            if (model.has(this.name)) {
                var val = model.get(this.name);
                if (val) {
                    this.model.set(this.name, app.currency.convertAmount(val, this._lastCurrencyId, currencyId), {
                        silent: true
                    });
                }
                var self = this;
                _.defer(function() {
                    self.model.trigger('change:' + self.name, self.model, self.model.get(self.name));
                });
            }
            this._lastCurrencyId = currencyId;
        }, this);
    },
    _valueChangeHandler: function(model, value) {
        if (this.action != 'edit') {
            this.render();
            return;
        }
        if (model.get('currency_id') !== this.model.get('currency_id')) {
            value = app.currency.convertAmount(value, model.get('currency_id'), this.model.get('currency_id'));
        }
        this.setCurrencyValue(value);
    },
    setCurrencyValue: function(value) {
        this.$('[name=' + this.name + ']').val(app.utils.formatNumberLocale(value));
    },
    format: function(value) {
        if (_.isNull(value) || _.isUndefined(value) || _.isNaN(value)) {
            value = '';
        }
        if (this.tplName === 'edit') {
            this.currencySfId = this.getCurrencyField().sfId;
            return app.utils.formatNumberLocale(value);
        }
        var baseRate = this.model.get(this.def.base_rate_field || 'base_rate');
        var transactionalCurrencyId = this.model.get(this.def.currency_field || 'currency_id'),
            convertedCurrencyId = transactionalCurrencyId,
            origTransactionValue = value;
        this.transactionValue = '';
        if (value === '') {
            return value;
        }
        if (this.def.is_base_currency) {
            transactionalCurrencyId = convertedCurrencyId = app.currency.getBaseCurrencyId();
        } else {
            if (this.def.convertToBase && transactionalCurrencyId !== app.currency.getBaseCurrencyId()) {
                if (this.def.showTransactionalAmount) {
                    this.transactionValue = app.currency.formatAmountLocale(this.model.get(this.name) || 0, transactionalCurrencyId);
                }
                value = app.currency.convertWithRate(value, baseRate) || 0;
                convertedCurrencyId = app.currency.getBaseCurrencyId();
            }
        }
        if ((this.def.is_base_currency || this.def.convertToBase) && !this.def.skip_preferred_conversion && app.user.get('preferences').currency_show_preferred) {
            var userPreferredCurrencyId = app.user.getPreference('currency_id');
            if (userPreferredCurrencyId !== transactionalCurrencyId) {
                convertedCurrencyId = userPreferredCurrencyId;
                this.transactionValue = app.currency.formatAmountLocale(this.model.get(this.name) || 0, transactionalCurrencyId);
                value = app.currency.convertWithRate(value, '1.0', app.metadata.getCurrency(userPreferredCurrencyId).conversion_rate);
            } else {
                this.transactionValue = '';
                convertedCurrencyId = transactionalCurrencyId;
                value = origTransactionValue;
            }
        }
        if (this.transactionValue.substr(0, 1) == '\u20AC') {
            this.transactionValue = this.transactionValue.substr(1, this.transactionValue.length-1) + this.transactionValue.substr(0, 1);
        }

        // Max Mozes 2015-12-16
        //Changing the String's structure if the currency is Euro
        if(this.def.symbol == false)
            return app.utils.formatNumber(value,0,2,',','.');
        var returnStr = app.currency.formatAmountLocale(value, convertedCurrencyId);
        if (returnStr.substr(0, 1) == '\u20AC') {
            returnStr = returnStr.substr(1, returnStr.length-1) + returnStr.substr(0, 1);
        }

        return returnStr;
    },
    unformat: function(value) {
        var unformattedValue;
        if (this.tplName === 'edit') {
            unformattedValue = app.utils.unformatNumberStringLocale(value);
        } else {
            unformattedValue = app.currency.unformatAmountLocale(value);
        }
        if (_.isFinite(unformattedValue) && this.def && this.def.precision) {
            unformattedValue = app.math.round(unformattedValue, this.def.precision, true);
        }
        return _.isFinite(unformattedValue) ? unformattedValue : value;
    },
    updateCss: function() {
        $('div.select2-drop.select2-drop-active').width('auto');
    },
    getCurrencyField: function() {
        if (!_.isNull(this._currencyField)) {
            return this._currencyField;
        }
        var currencyDef = this.model.fields[this.def.currency_field || 'currency_id'];
        currencyDef.type = 'enum';
        currencyDef.options = app.currency.getCurrenciesSelector(Handlebars.compile('{{symbol}} ({{iso4217}})'));
        currencyDef.enum_width = '100%';
        currencyDef.searchBarThreshold = this.def.searchBarThreshold || 7;
        this._currencyField = app.view.createField({
            def: currencyDef,
            view: this.view,
            viewName: this.tplName,
            model: this.model
        });
        this._currencyField.defaultOnUndefined = false;
        return this._currencyField;
    },
    setMode: function(name) {
        this._super('setMode', [name]);
        this.getCurrencyField().setMode(name);
    },
    dispose: function() {
        if (this._currencyField) {
            this._currencyField.dispose();
            this._currencyField = null;
        }
        app.view.Field.prototype.dispose.call(this);
    }
})
