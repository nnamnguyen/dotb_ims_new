
/**
 * @class View.Fields.Base.UrlField
 * @alias DOTB.App.view.fields.BaseUrlField
 * @extends View.Fields.Base.BaseField
 */
({
    /**
     * @inheritdoc
     *
     * The direction for this field should always be `ltr`.
     */
    direction: 'ltr',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super("initialize", arguments);
        //Generated URL's should not be editable
        if (app.utils.isTruthy(this.def.gen)) {
            this.def.readonly = true;
        }
    },

    format:function(value){
        if (value && !value.match(/^([a-zA-Z]+):\/\//)) {
            value = "http://" + value;
        }
        return value;
    },
    unformat:function(value){
        value = (value!='' && value!='http://') ? value.trim() : "";
        return value;
    },
    getFieldElement: function() {
        return this.$('a');
    },
    _render: function() {
        this.def.link_target = _.isUndefined(this.def.link_target) ? '_blank' : this.def.link_target;
        app.view.Field.prototype._render.call(this);
    }
})
