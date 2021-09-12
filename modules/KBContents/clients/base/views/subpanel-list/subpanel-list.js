
/**
 * Custom Subpanel Layout for Revenue Line Items.
 *
 * @class View.Views.Base.KBContents.SubpanelListView
 * @alias DOTB.App.view.views.BaseKBContentsSubpanelListView
 * @extends View.Views.Base.SubpanelListView
 */
({
    extendsFrom: 'SubpanelListView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this.plugins = _.union(this.plugins || [], ['KBContent']);
        this._super('initialize', [options]);
    }
})
