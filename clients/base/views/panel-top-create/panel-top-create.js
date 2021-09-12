
/**
 * Header section for Subpanel layouts.
 *
 * @class View.Views.Base.PanelTopView
 * @alias DOTB.App.view.views.BasePanelTopView
 * @extends View.View
 */
({
    extendsFrom: 'PanelTopView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.context.set('collapsed', false);
    },

    /**
     * @inheritdoc
     *
     * Overrides the default related-record create to add the new item inline
     *
     * @override
     */
    createRelatedClicked: function(event) {},

    /**
     * @inheritdoc
     *
     * Overrides the parent togglePanel since we don't allow panel toggling in create
     *
     * @override
     */
    togglePanel: function() {}
})
