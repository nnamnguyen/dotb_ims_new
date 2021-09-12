

/**
 * @class View.Views.Base.KBContentsPanelTopForCases
 * @alias DOTB.App.view.views.BaseKBContentsPanelTopForCases
 * @extends View.Views.Base.PanelTopView
 */

({
    extendsFrom: 'PanelTopView',
    plugins: ['KBContent'],
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
    },
    /**
     * Event handler for the create button.
     *
     * @param {Event} event The click event.
     */
    createRelatedClicked: function(event) {
        this.createArticleSubpanel();
    },
})
