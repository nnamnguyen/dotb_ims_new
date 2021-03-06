
/**
 * @class View.Fields.Base.LanguageField
 * @alias DOTB.App.view.fields.BaseLanguageField
 * @extends View.Fields.Base.EnumField
 */
({
    extendsFrom: 'EnumField',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.model.setDefault(this.name, this._getDefaultOption());
    },

    /**
     * Ensure we load enum templates
     *
     * @override
     * @private
     */
    _loadTemplate: function() {
        this.type = 'enum';
        app.view.Field.prototype._loadTemplate.call(this);
        this.type = 'language';
    },

    /**
     * @inheritdoc
     * If no value, set the application default language as default value.
     * If edit mode, set the application default language on the model.
     */
    format: function(value) {
        if (!this.items[value]) {
            value = this._getDefaultOption();
            this.model.set(this.name, value);
        }

        return value;
    },

    /**
     * @override
     *
     * @return {string}  The default language as the default value
     */
    _getDefaultOption: function(optionsKeys) {
        return app.lang.getDefaultLanguage();
    },
})
