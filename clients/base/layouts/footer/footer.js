
/**
 * @class View.Layouts.Base.FooterLayout
 * @alias DOTB.App.view.layouts.BaseFooterLayout
 * @extends View.Layout
 */
({
    /**
     * Places all components within this layout inside `btn-toolbar` div.
     *
     * @param {View.View|View.Layout} component View or layout component.
     * @override
     * @protected
     */
    _placeComponent: function(component) {
        this.$('.btn-toolbar').append(component.el);
    },

    /**
     * @inheritdoc
     */
    _render: function() {
        // FiXME SC-5765 the logo should be a separate view, so we can update it based
        // on the re-render of this layout
        this.$('[data-metadata="logo"]').attr('src', app.metadata.getLogoUrl());
        return this._super('_render');
    }
})
