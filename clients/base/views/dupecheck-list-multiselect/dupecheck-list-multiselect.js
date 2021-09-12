
/**
 * @class View.Views.Base.DupecheckListMultiselectView
 * @alias DOTB.App.view.views.BaseDupecheckListMultiselectView
 * @extends View.Views.Base.DupecheckListView
 */
({
    extendsFrom: 'DupecheckListView',
    additionalTableClasses: 'duplicates-multiselect',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins, ['MassCollection']);
        this._super('initialize', [options]);
    }
})
