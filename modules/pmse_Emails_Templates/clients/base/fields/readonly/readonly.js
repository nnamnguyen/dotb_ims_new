
/**
 * @class View.Fields.Base.pmse_Emails_Templates.ReadonlyField
 * @alias DOTB.App.view.fields.Basepmse_Emails_TemplatesReadonlyField
 * @extends View.Fields.Base.BaseField
 */
({
    fieldTag: 'input.inherit-width',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        options.def.readonly = true;
        this._super('initialize', [options]);
    },
    
    _render: function() {
        if (this.view.name === 'record') {
            this.def.link = false;
        } else if (this.view.name === 'preview') {
            this.def.link = true;
        }
        this._super('_render');
    },

    /**
     * Gets the recipients DOM field
     *
     * @returns {Object} DOM Element
     */
    getFieldElement: function() {
        return this.$(this.fieldTag);
    },

    /**
     * @inheritdoc
     */
    format: function(value) {
        return app.lang.getModuleName(value, {plural: true})
    }
})
