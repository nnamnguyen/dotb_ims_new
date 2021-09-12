
/**
 * @class View.Fields.Base.Styleguide.DateField
 * @alias DOTB.App.view.fields.BaseStyleguideDateField
 * @extends View.Fields.Base.DateField
 */

({
    extendsFrom: 'DateField',

    /**
     * @inheritdoc
     */
    _dispose: function() {
        // FIXME: new date picker versions have support for plugin removal/destroy
        // we should do the upgrade in order to prevent memory leaks
        // FIXME: the base date field has a bug in disposing a datepicker field
        // that has been instantiated but not rendered.

        if (this._hasDatePicker && !_.isUndefined(this.$(this.fieldTag).data('datepicker'))) {
            $(window).off('resize', this.$(this.fieldTag).data('datepicker').place);
        }
    }
})
