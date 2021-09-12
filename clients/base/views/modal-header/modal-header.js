
/**
 * @class View.Views.Base.ModalHeaderView
 * @alias DOTB.App.view.views.BaseModalHeaderView
 * @extends View.View
 */
({
    events: {
        'click .close' : 'close'
    },
    close: function() {
        this.layout.hide();
    },
    setTitle: function(title) {
        this.title = title;
    },
    setButton: function(buttons) {
        this.buttons = buttons;
    }
})
