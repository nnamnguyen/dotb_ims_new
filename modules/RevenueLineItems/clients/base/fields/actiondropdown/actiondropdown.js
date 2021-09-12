
/**
 * Create a dropdown button that contains multiple
 * {@link View.Fields.Base.RowactionField} fields.
 *
 * @class View.Fields.Base.RevenueLineItems.ActiondropdownField
 * @alias DOTB.App.view.fields.BaseRevenueLineItemsActiondropdownField
 * @extends View.Fields.Base.ActiondropdownField
 */
({
    extendsFrom: 'ActiondropdownField',

    /**
     * Enable or disable caret depending on if there are any enabled actions in the dropdown list
     *
     * @inheritdoc
     * @private
     */
    _updateCaret: function() {
        // Left empty on purpose, the menu should always show
    }
})
