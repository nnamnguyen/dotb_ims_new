
/**
 * @class View.Layouts.Base.PreviewLayout
 * @alias DOTB.App.view.layouts.BasePreviewLayout
 * @extends View.Layout
 */
({
    events: {
        'click .closeSubdetail': 'hidePreviewPanel'
    },
    initialize: function(opts) {
        app.view.Layout.prototype.initialize.call(this, opts);
        app.events.on('preview:open', this.showPreviewPanel, this);
        app.events.on('preview:close', this.hidePreviewPanel, this);
        app.events.on('preview:pagination:hide', this.hidePagination, this);
    },

    /**
     * Show the preview panel, if it is part of the active drawer
     * @param event (optional) DOM event
     */
    showPreviewPanel: function(event) {
        if (_.isUndefined(app.drawer) || app.drawer.isActive(this.$el)) {
            var layout = this.$el.parents('.sidebar-content');
            layout.find('.side-pane').removeClass('active');
            layout.find('.dashboard-pane').hide();
            layout.find('.preview-pane').addClass('active');

            var defaultLayout = this.closestComponent('sidebar');
            if (defaultLayout) {
                defaultLayout.trigger('sidebar:toggle', true);
            }
        }
    },

    /**
     * Hide the preview panel, if it is part of the active drawer
     * @param event (optional) DOM event
     */
    hidePreviewPanel: function(event) {
        if (_.isUndefined(app.drawer) || app.drawer.isActive(this.$el)) {
            var layout = this.$el.parents('.sidebar-content');
            layout.find('.side-pane').addClass('active');
            layout.find('.dashboard-pane').show();
            layout.find('.preview-pane').removeClass('active');
            app.events.trigger('list:preview:decorate', false);
        }
    },

    hidePagination: function() {
        if (_.isUndefined(app.drawer) || app.drawer.isActive(this.$el)) {
            this.hideNextPrevious = true;
            this.trigger('preview:pagination:update');
        }
    }
});
