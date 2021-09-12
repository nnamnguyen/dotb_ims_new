({
    initialize: function(options){
        this._super('initialize', [options]);
    },

    loadData: function(options){
        options = options || {};

        _.extend(options, {
            success: _.bind(function (data) {
                this.model.set(data, {silent: true});
                this.render();
            }, this)
        });

        app.api.call("read", app.api.buildURL('get-default-preset-import'), null, options);
    }
})