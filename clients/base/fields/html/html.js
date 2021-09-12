
/**
 * @class View.Fields.Base.HtmlField
 * @alias DOTB.App.view.fields.BaseHtmlField
 * @extends View.Fields.Base.BaseField
 */
({
    fieldSelector: '.htmlareafield', //iframe selector

    /**
     * @inheritdoc
     *
     * The direction for this field should always be `ltr`.
     */
    direction: 'ltr',

    /**
     * @inheritdoc
     *
     * The html area is always a readonly field.
     * (see htmleditable for an editable html field)
     */
    initialize: function(options) {  
        options.def.readonly = true;
        this._super('initialize', [options]);
    },

    /**
     * @inheritdoc
     *
     * Set the name of the field on the iframe as well as the contents
     *
     * @private
     */
    _render: function() { 
        app.view.Field.prototype._render.call(this);

        this._getFieldElement().attr('name', this.name);
        this.setViewContent();
    },

    /**
     * Sets read only html content in the iframe
     * Add html field to subpanel - Lap Nguyen
     */
    setViewContent: function(){   
        var value = this.value || this.def.default_value;
        var field = this._getFieldElement();
        field.html(value);
    },

    /**
     * Finds iframe element in the field template
     *
     * @return {HTMLElement} element from field template
     * @private
     */
    _getFieldElement: function() {   
        //return this.$el.find(this.fieldSelector);
        return this.$el.closest('td').find('span.list');
    },

    /**
     * Finds value is HTML syntax
     *
     * @return {true} when text is a html
     * Custom By Lap Nguyen
     */
    is_html : function(html) {
        var d = document.createElement('div');
        d.innerHTML = html;
        return ( d.innerHTML === html );
    }
})
