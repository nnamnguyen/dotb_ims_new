
({
    extendsFrom: 'HeaderpaneView',

    events: {
        'click [name=select_button]':   '_select',
        'click [name=cancel_button]': '_cancel'
    },

    /**
     * Close the drawer and pass in the selected model
     *
     * @private
     */
    _select: function() {
        var selectedModel = this.context.get('selection_model');

        if (selectedModel) {
            app.drawer.close(selectedModel);
        } else {
            this._cancel();
        }
    },

    /**
     * Close the drawer
     *
     * @private
     */
    _cancel: function() {
        app.drawer.close();
    }
})
