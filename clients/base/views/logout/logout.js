
/**
 * @class View.Views.Base.LogoutView
 * @alias DOTB.App.view.views.BaseLogoutView
 * @extends View.View
 */
({
    events: {
        "click [name=login_button]": "login",
    },

    /**
     * @override
     * @private
     */
    _render: function() {
        this.logoUrl = app.metadata.getLogoUrl();
        app.view.View.prototype._render.call(this);
        this.refreshAddtionalComponents();
        return this;
    },

    /**
     * Refresh additional components
     */
    refreshAddtionalComponents: function() {
        _.each(app.additionalComponents, function(component) {
            component.render();
        });
    },

    /**
     * @deprecated
     */
    login_form: function() {
        app.logger.warn('`View.Views.Base.LogoutView#login_form` has been deprecated since 7.9.1.0 and' +
            ' will be removed in a future release. Please use `View.Views.Base.LogoutView#login`.');
        this.login();
    },

    /**
     * Process Login
     */
    login: function() {
        app.router.login();
    }
})
