
/**
 * @class View.Views.Base.Reports.DrillthroughHeaderpaneView
 * @alias DOTB.App.view.views.BaseReportsDrillthroughHeaderpaneView
 * @extends View.Views.Base.HeaderpaneView
 */
({
    extendsFrom: 'HeaderpaneView',

    /**
     * @inheritdoc
     */
    _renderHtml: function() {
        this._super('_renderHtml');

        this.layout.once('drillthrough:closedrawer:fire', _.bind(function() {
            this.$el.off();
            app.drawer.close();
        }, this));
    },

    /**
     * @inheritdoc
     */
    _formatTitle: function(title) {
        var chartModule = this.context.get('chartModule');
        return app.lang.get('LBL_MODULE_NAME', chartModule);
    }
})
