
/**
 * @class View.Layouts.Base.ASDashletFilterLayout
 * @alias DOTB.App.view.layouts.BaseASDashletFilterLayout
 * @extends View.Layout
 */
({
    className: 'dashablelist-filter',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        //Set up a listener for the configuration save
        this.listenTo(this.layout, 'asdashlet:config:save', this.saveFilterToDashlet);
    },

    /**
     * Set the current filter ID and def to be seen on the dashlet
     *
     * @private
     */
    saveFilterToDashlet: function() {
        var filterPanelLayout = this.getComponent('filterpanel');
        if (!filterPanelLayout) {
            return;
        }

        this.model.set('currentFilterId', filterPanelLayout.context.get('currentFilterId'));
    }
})
