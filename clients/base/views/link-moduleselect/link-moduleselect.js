
/**
 * @class View.Views.Base.LinkModuleselectView
 * @alias DOTB.App.view.views.BaseLinkModuleselectView
 * @extends View.View
 */
({
    linkModules: [],
    events: {
        'click label[for=relationship]': 'setFocus'
    },
    initialize: function (options) {
        app.view.View.prototype.initialize.call(this, options);
        this.linkModules = this.context.get("linkModules");
    },
    setFocus: function (e) {
        this.$("#relationship").select2("open");
    },
    _renderHtml: function (ctx, options) {
        var self = this;
        app.view.View.prototype._renderHtml.call(this, ctx, options);
        this.$(".select2").select2({
            width: '100%',
            allowClear: true,
            placeholder: app.lang.get("LBL_SEARCH_SELECT")
        }).on("change", function (e) {
            if (_.isEmpty(e.val)) {
                self.context.trigger("link:module:select", null);
            } else {
                var meta = self.linkModules[e.val];
                self.context.trigger("link:module:select", {link: meta.link, module: meta.module});
            }
        });
    },
    _dispose: function() {
        this.$(".select2").select2('destroy');
        app.view.View.prototype._dispose.call(this);
    }
})
