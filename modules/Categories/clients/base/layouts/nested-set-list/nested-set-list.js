
/**
 * @class View.Layouts.Base.NestedSetListLayout
 * @alias DOTB.App.view.layouts.BaseNestedSetListLayout
 * @extends View.Layout
 */
({
    plugins: ['ShortcutSession'],

    shortcuts: [
        'Sidebar:Toggle'
    ],

    /**
     * @inheritdoc
     */
    loadData: function(options) {
        var fields = _.union(this.getFieldNames(), (this.context.get('fields') || []));
        this.context.set('fields', fields);
        this._super('loadData', [options]);
    }
})
