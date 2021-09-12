
/**
 * @class View.Views.Base.DupecheckListEditView
 * @alias DOTB.App.view.views.BaseDupecheckListEditView
 * @extends View.Views.Base.DupecheckListView
 */
({
    extendsFrom: 'DupecheckListView',
    additionalTableClasses: 'duplicates-selectedit',

    addActions: function() {
        if (this.actionsAdded) return;
        this._super('addActions');

        var firstRightColumn = this.rightColumns[0];
        if (firstRightColumn && _.isArray(firstRightColumn.fields)) {
            //Prepend Select and Edit action
            firstRightColumn.fields.unshift({
                type: 'rowaction',
                label: 'LBL_LISTVIEW_SELECT_AND_EDIT',
                css_class: 'btn btn-invisible btn-link ellipsis_inline',
                tooltip: 'LBL_LISTVIEW_SELECT_AND_EDIT',
                event: 'list:dupecheck-list-select-edit:fire'
            });
            this.rightColumns[0] = firstRightColumn;
        }
        this.actionsAdded = true;
    }
})
