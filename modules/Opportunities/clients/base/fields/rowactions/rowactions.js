
/*
 * @class View.Fields.Base.Opportunities.RowactionsField
 * @alias DOTB.App.view.fields.BaseOpportunitiesRowactionsField
 * @extends View.Fields.Base.RowactionsField
 */
({
    extendsFrom: 'RowactionsField',

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
