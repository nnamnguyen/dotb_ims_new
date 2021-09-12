
/**
 * @class View.Views.Base.SearchDashboardHeaderpaneView
 * @alias DOTB.App.view.views.BaseSearchDashboardHeaderpaneView
 * @extends View.View
 */
({
    className: 'search-dashboard-headerpane',
    events: {
        'click a[name=collapse_button]' : 'collapseClicked',
        'click a[name=expand_button]' : 'expandClicked',
        'click a[name=reset_button]' : 'resetClicked'
    },

    /**
     * Collapses all the dashlets in the dashboard.
     */
    collapseClicked: function() {
        this.context.trigger('dashboard:collapse:fire', true);
    },

    /**
     * Expands all the dashlets in the dashboard.
     */
    expandClicked: function() {
        this.context.trigger('dashboard:collapse:fire', false);
    },

    /**
     * Triggers 'facets:reset' event to reset the facets applied on the search.
     */
    resetClicked: function() {
        this.context.parent.trigger('facets:reset', true);
    }
})
