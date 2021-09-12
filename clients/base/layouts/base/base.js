({
    initialize: function() {
        this._super('initialize', arguments);
        if (app.tooltip) {
            this.on('render', app.tooltip.clear);
        }
    }
})
