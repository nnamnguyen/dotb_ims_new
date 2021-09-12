
/**
 * @class View.Fields.Base.PiinameField
 * @alias DOTB.App.view.fields.BasePiinameField
 * @extends View.Fields.Base.BaseField
 */
({
    /**
     * @inheritdoc
     *
     * Convert the raw field type name into the label of the field
     * of the Pii module or Pii parent module; if not available,
     * use raw value.
     */
    format: function(value) {
        var module;
        var field;

        if (!this.context) {
            return value;
        }

        if (this.context.has('piiModule')) {
            module = this.context.get('piiModule');
            field = app.metadata.getField({module: module, name: value});
        } else if (this.context.parent) {
            var model = this.context.parent.get('model');
            module = model.module;
            field = model.fields[value];
        }

        if (field) {
            value = app.lang.get(field.label || field.vname, module);
        }

        return value;
    }
})
