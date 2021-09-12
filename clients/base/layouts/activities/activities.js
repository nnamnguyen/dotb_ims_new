
/**
 * @class View.Layouts.Base.ActivitiesLayout
 * @alias DOTB.App.view.layouts.BaseActivitiesLayout
 * @extends View.Layout
 */
({
    /**
     * @inheritdoc
     */
    _render: function() {
        this._super('_render');

        if (!app.config.activityStreamsEnabled) {
            this.$('.search-filter').addClass('hide');
        }

        return this;
    }
})
