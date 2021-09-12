
/**
 * @class Model.Datas.Base.EmailAddressesModel
 * @alias DOTB.App.model.datas.BaseEmailAddressesModel
 * @extends Data.Bean
 */
({
    /**
     * @inheritdoc
     *
     * Defaults `opt_out` to the `new_email_addresses_opted_out` config.
     */
    initialize: function(attributes) {
        this._defaults = _.extend({}, this._defaults, {opt_out: app.config.newEmailAddressesOptedOut});
        app.Bean.prototype.initialize.call(this, attributes);
    }
})
