
/**
 * @class View.Layouts.Base.Tags.SubpanelsLayout
 * @alias DOTB.App.view.layouts.TagsSubpanelsLayout
 * @extends View.Layout.Base.SubpanelsLayout
 */
({
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        // Create dynamic subpanel metadata
        var dSubpanels = app.utils.getDynamicSubpanelMetadata(options.module);

        if (dSubpanels.components) {
            _.each(dSubpanels.components, function(sub) {
                if (sub.layout) {
                    sub['override_paneltop_view'] = 'panel-top-readonly';
                }
            }, this);
        }

        // Merge dynamic subpanels with existing metadata
        options.meta = _.extend(
            options.meta || {},
            dSubpanels
        );

        // Call the parent
        this._super('initialize', [options]);
    }
})
