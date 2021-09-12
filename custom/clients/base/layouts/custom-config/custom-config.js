/**
 * Created by sergiu.precup on 7/2/18.
 */

({
    initialize: function(options){
        this._super('initialize', [options]);
    },

    loadData: function(options){
        options = options || {};

        _.extend(options, {
            success: _.bind(function (data) {
                this.model.set(data, {silent: true});
                this.model.setSyncedAttributes(data);
                this.render();
            }, this),
            error: _.bind(function () {
            }, this),
            complete: options ? options.complete : null
        })

        app.api.call("read", app.api.buildURL('configurator'), null, options);
    }
})
