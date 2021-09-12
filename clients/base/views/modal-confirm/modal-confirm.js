
/**
 * @class View.Views.Base.ModalConfirmView
 * @alias DOTB.App.view.views.BaseModalConfirmView
 * @extends View.View
 */
({
    events: {
        'click [name=close_button]' : 'close',
        'click [name=ok_button]' : 'ok'
    },
    initialize: function(options) {
        this.message = options.layout.confirmMessage;
        app.view.View.prototype.initialize.call(this, options);
    },
    close: function(evt) {
        this.layout.context.trigger("modal:close");
    },
    ok: function(evt) {
        this.layout.context.trigger("modal:callback");
    }
})
