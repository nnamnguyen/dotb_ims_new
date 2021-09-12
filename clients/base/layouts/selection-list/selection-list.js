
/**
 * @class View.Layouts.Base.SelectionListLayout
 * @alias DOTB.App.view.layouts.BaseSelectionListLayout
 * @extends View.Layout
 */
({
    plugins: ['ShortcutSession'],

    shortcuts: [
        'Headerpane:Cancel',
        'Sidebar:Toggle'
    ],

    loadData: function(options) {
        var fields = _.union(this.getFieldNames(), (this.context.get('fields') || []));
        this.context.set('fields', fields);
        this._super('loadData', [options]);
    }
})
