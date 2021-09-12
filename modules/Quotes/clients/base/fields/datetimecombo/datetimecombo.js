
/**
 * @class View.Fields.Base.Quotes.DatetimecomboField
 * @alias DOTB.App.view.fields.BaseQuotesDatetimecomboField
 * @extends View.Fields.Base.DatetimecomboField
 */
({
    extendsFrom: 'DatetimecomboField',

    /**
     * @inheritdoc
     */
    _dispose: function() {
        // FIXME: this is a bad "fix" added -- when SC-2395 gets done to upgrade bootstrap we need to remove this
        if (this._hasTimePicker) {
            this.$(this.secondaryFieldTag).timepicker('remove');
        }

        if (this._hasDatePicker && this.$(this.fieldTag).data('datepicker')) {
            $(window).off('resize', this.$(this.fieldTag).data('datepicker').place);
        }

        this._hasTimePicker = false;
        this._hasDatePicker = false;

        this._super('_dispose');
    }
})
