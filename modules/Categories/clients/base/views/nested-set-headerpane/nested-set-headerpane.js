
/**
 * @class View.Views.Base.NestedSetHeaderpaneView
 * @alias DOTB.App.view.views.BaseNestedSetHeaderpaneView
 * @extends View.Views.Base.HeaderpaneView
 */
({
    extendsFrom: 'HeaderpaneView',

    /**
     * @inheritdoc
     */
    _renderHtml: function() {
        var titleTemplate = Handlebars.compile(this.context.get('title') || app.lang.getAppString('LBL_SEARCH_AND_SELECT')),
            moduleName = app.lang.get('LBL_MODULE_NAME', this.module);
        this.title = titleTemplate({module: moduleName});
        this._super('_renderHtml');

        this.layout.on('selection:closedrawer:fire', _.once(_.bind(function() {
            this.$el.off();
            app.drawer.close();
        }, this)));
    }
})
