
/**
 * @class View.Fields.Base.Dashboards.FavoriteField
 * @alias DOTB.App.view.fields.DashboardsBaseFavoriteField
 * @extends View.Fields.Base.FavoriteField
 */
({
    // FIXME TY-1463 Remove this file.
    /**
     * Check first if the model exists before rendering.
     *
     * The dashboards currently reside in the Home module. The Home module does
     * not have favorites enabled. The dashboards do have favorites enabled.
     * In order to show the favorite icon on dashboards, we need to bypass
     * the favoritesEnabled check.
     *
     * @override
     * @private
     */
    _render: function() {
        // can't favorite something without an id
        if (!this.model.get('id')) {
            return null;
        }
        return app.view.Field.prototype._render.call(this);
    }
})
