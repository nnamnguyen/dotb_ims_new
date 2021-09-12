
/**
 * @class Model.Datas.Base.UserSignaturesModel
 * @alias DOTB.App.model.datas.BaseUserSignaturesModel
 * @extends Data.Bean
 */
({
    /**
     * @inheritdoc
     *
     * Wraps the success callback and makes a ping call when the default signature
     * attribute has changed since we are making changes to the user
     * preferences which requires a metadata refresh.
     */
    save: function(attributes, options) {
        var success;
        var syncedAttrs = this.getSynced();
        var changedAttrs = this.changedAttributes(syncedAttrs);

        if (_.has(changedAttrs, 'is_default')) {
            options = options || {};
            success = options.success;
            options.success = function() {
                app.api.call('read', app.api.buildURL('ping'));
                if (_.isFunction(success)) {
                    success.apply(options.context, arguments);
                }
            };
        }

        return app.Bean.prototype.save.call(this, attributes, options);
    }
})
