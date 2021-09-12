
/**
 * Layout that places components using bootstrap fluid layout divs.
 *
 * @class View.Layouts.Base.ListLayout
 * @alias DOTB.App.view.layouts.BaseListLayout
 * @extends View.Layout
 */
({
    /**
     * Places a view's element on the page. This shoudl be overriden by any custom layout types.
     * @param {View.View} comp
     * @protected
     * @method
     */
    _placeComponent: function(comp, def) {
        var size = def.size || 12;

        // Helper to create boiler plate layout containers
        function createLayoutContainers(self) {
            // Only creates the containers once
            if (!self.$el.children()[0]) {
                comp.$el.addClass('list');
            }
        }

        createLayoutContainers(this);

        // All components of this layout will be placed within the
        // innermost container div.
        this.$el.append(comp.el);
    }

})
