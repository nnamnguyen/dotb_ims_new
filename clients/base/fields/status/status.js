
/**
 * @class View.Fields.Base.StatusField
 * @alias DOTB.App.view.fields.BaseStatusField
 * @extends View.Fields.Base.BaseField
 */
({
    /**
     * Additional CSS Classes to be added to hbs
     */
    cssClasses: '',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.buildCSSClasses();
    },

    /**
     * Gets the field value and sets cssClasses
     */
    buildCSSClasses: function() {
        var status = this.model.get(this.name);
        if (status) {
            status = status.replace(' ', '_');
            this.cssClasses = 'field_' + this.name + '_' + status;
        }
    }
})
