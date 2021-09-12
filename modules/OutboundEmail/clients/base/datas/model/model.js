
/**
 * @class Model.Datas.Base.OutboundEmailModel
 * @alias DOTB.App.model.datas.BaseOutboundEmailModel
 * @extends Data.Bean
 */
({
    /**
     * @inheritdoc
     *
     * Defaults `name` to the current user's full name and `email_address` and
     * `email_address_id` to the requisite values representing the current
     * user's primary email address.
     */
    initialize: function(attributes) {
        var defaults = {};
        var email = app.user.get('email');

        defaults.name = app.user.get('full_name');
        defaults.email_address = app.utils.getPrimaryEmailAddress(app.user);
        defaults.email_address_id = _.chain(email)
            .findWhere({email_address: defaults.email_address})
            .pick('email_address_id')
            .values()
            .first()
            .value();

        this._defaults = _.extend({}, this._defaults, defaults);
        app.Bean.prototype.initialize.call(this, attributes);
    }
})
