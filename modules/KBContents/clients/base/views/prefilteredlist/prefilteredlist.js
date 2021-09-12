
/**
 * @class View.Views.Base.PrefilterelistView
 * @alias DOTB.App.view.views.BasePrefilteredlistView
 * @extends View.Views.Base.RecordlistView
 */
({
    extendsFrom: 'RecordlistView',

    /**
     * Load recordlist templates.
     * @inheritdoc
     */
    _loadTemplate: function(options) {
        this.tplName = 'recordlist';
        this.template = app.template.getView(this.tplName);
    }
})
