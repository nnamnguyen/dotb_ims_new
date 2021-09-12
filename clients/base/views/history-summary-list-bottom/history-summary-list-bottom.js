
/**
 * @class View.Views.Base.HistorySummaryListBottomView
 * @alias DOTB.App.view.views.BaseHistorySummaryListBottomView
 * @extends View.Views.Base.ListBottomView
 */
({
    extendsFrom: 'ListBottomView',

    /**
     * Assigns label for "More history..." since History isn't
     * a proper module and doesn't fetch lang strings
     * @override
     */
    setShowMoreLabel: function() {
        this.showMoreLabel = app.lang.get('LBL_MORE_HISTORY');
    }
})
