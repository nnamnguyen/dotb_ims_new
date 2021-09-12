
// jscs:disable jsDoc
/**
 * relate Widget.
 *
 * Extends from BaseRelateField widget
 *
 * @class View.Fields.Base.pmse_Inbox.RelateField
 * @alias DOTB.App.view.fields.Basepmse_InboxRelateField
 * @extends View.Fields.Base.RelateField
 */
// jscs:anable jsDoc
({
    /**
     * Renders relate field
     */
    _render: function() {
        // a way to override viewName
        if (this.def.view) {
            this.options.viewName = this.def.view;
        }
        this._super('_render');
    }

});
