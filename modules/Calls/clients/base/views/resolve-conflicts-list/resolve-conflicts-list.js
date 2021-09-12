
/**
 * @class View.Views.Base.Calls.ResolveConflictsListView
 * @alias DOTB.App.view.views.BaseCallsResolveConflictsListView
 * @extends View.Views.Base.ResolveConflictsListView
 */
({
    extendsFrom: 'ResolveConflictsListView',

    /**
     * @inheritdoc
     *
     * The invitees field should not be displayed on list views. It is removed
     * before comparing models so that it doesn't get included.
     */
    _buildFieldDefinitions: function(modelToSave, modelInDb) {
        modelToSave.unset('invitees');
        this._super('_buildFieldDefinitions', [modelToSave, modelInDb]);
    }
})
