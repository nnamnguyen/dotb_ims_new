
/**
 * @class View.Views.Base.pmse_Inbox.RecordlistView
 * @alias DOTB.App.view.views.Basepmse_InboxRecordlistView
 * @extends View.Views.Base.RecordlistView
 */
({
    extendsFrom: 'RecordlistView',

    contextEvents: {
        "list:process:fire": "showCase"
    },

    showCase: function (model) {
        //var url = model.module + '/' + model.id + '/layout/show-case/' + model.get('flow_id');
        var ShowCaseUrl = app.router.buildRoute(model.module, model.get('id2'), 'layout/show-case/' + model.get('flow_id'));
        var ShowCaseUrlBwc = app.bwc.buildRoute(model.module, '', 'showCase', {id:model.get('flow_id')});
        var DotbModule = model.get('cas_dotb_module');
        if (app.metadata.getModule(DotbModule).isBwcEnabled) {
            app.router.navigate(ShowCaseUrlBwc , {trigger: true, replace: true });
        } else {
            app.router.navigate(ShowCaseUrl , {trigger: true, replace: true });
        }
    },

    /**
     * Decorate a row in the list that is being shown in Preview
     * @override pmse_Inbox uses flow_id instead of id to keep track of records
     * and add them to the DOM
     * @param model Model for row to be decorated.  Pass a falsy value to clear decoration.
     */
    decorateRow: function (model) {
        // If there are drawers, make sure we're updating only list views on active drawer.
        if (_.isUndefined(app.drawer) || app.drawer.isActive(this.$el)) {
            this._previewed = model;
            this.$("tr.highlighted").removeClass("highlighted current above below");
            if (model) {
                //use flow_id here since that's what is in the DOM
                var rowName = model.module + "_" + model.get('flow_id');
                var curr = this.$("tr[name='" + rowName + "']");
                curr.addClass("current highlighted");
                curr.prev("tr").addClass("highlighted above");
                curr.next("tr").addClass("highlighted below");
            }
        }
    }
})
