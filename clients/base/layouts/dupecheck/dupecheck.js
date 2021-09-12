
/**
 * Layout displays a list of duplicate records found along with a count
 *
 * Note: Next step will be to add ability to switch to a filter list (and back).
 *       This is why this is in a layout.
 *
 * @class View.Layouts.Base.DupecheckLayout
 * @alias DOTB.App.view.layouts.BaseDupecheckLayout
 * @extends View.Layout
 */
({
    initialize: function(options) {
        if(options.context.has('dupelisttype')) {
            options.meta = this.switchListView(options.meta, options.context.get('dupelisttype'));
        }
        app.view.Layout.prototype.initialize.call(this, options);
    },

    switchListView: function(meta, dupelisttype) {
        var listView = _.find(meta.components, function(component) {
            return (component.name === 'dupecheck-list');
        });
        listView.view = dupelisttype;
        return meta;
    }
})
