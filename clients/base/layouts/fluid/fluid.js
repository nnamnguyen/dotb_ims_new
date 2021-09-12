
/**
 * Layout that places components using bootstrap fluid layout divs.
 *
 * @class View.Layouts.Base.FluidLayout
 * @alias DOTB.App.view.layouts.BaseFluidLayout
 * @extends View.Layout
 */
({
    /**
     * Places a view's element on the page. This should be overriden by any custom layout types.
     * In layout defs, the child component should have a `span` definition corresponding to the bootstrap scaffold.
     * @param {View.View} comp
     * @protected
     */
    _placeComponent: function(comp, def) {
        var compdef = def.layout || def.view,
            size = compdef.span || 4;

        if (!this.$el.children()[0]) {
            this.$el.addClass("container-fluid").append('<div class="row-fluid"></div>');
        }

        //Create a new td and add the layout to it
        $().add("<div></div>").addClass("span" + size).append(comp.el).appendTo(this.$el.find("div.row-fluid")[0]);
    }
})
