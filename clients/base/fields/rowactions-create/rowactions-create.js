
/**
 * @class View.Fields.Base.RowactionsCreateField
 * @alias DOTB.App.view.fields.BaseRowactionsCreateField
 * @extends View.Fields.Base.RowactionsField
 */
({
    extendsFrom: 'FieldsetField',

    /**
     * @inheritdoc
     *
     * Overriding FieldsetField's method to use def.buttons not def.fields
     *
     * @override
     */
    _getChildFieldsMeta: function() {
        return app.utils.deepCopy(this.def.buttons);
    }
})
