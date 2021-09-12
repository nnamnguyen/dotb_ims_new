
/**
 * @class View.Fields.Base.Quotes.DateField
 * @alias DOTB.App.view.fields.BaseQuotesDateField
 * @extends View.Fields.Base.DateField
 */
({
    extendsFrom: 'DateField',

    /**
     * @inheritdoc
     */
    _dispose: function() {
        // FIXME: this is a bad "fix" added -- when SC-2395 gets done to upgrade bootstrap we need to remove this
        if (this._hasDatePicker && this.$(this.fieldTag).data('datepicker')) {
            $(window).off('resize', this.$(this.fieldTag).data('datepicker').place);
        }
        this._hasDatePicker = false;

        this._super('_dispose');
    }
})
