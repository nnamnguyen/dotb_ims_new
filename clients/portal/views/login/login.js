
/**
 * Login form view.
 *
 * @class View.Views.Portal.LoginView
 * @alias DOTB.App.view.views.PortalLoginView
 * @extends View.Views.Base.LoginView
 */
({
    plugins: ['ErrorDecoration'],

    events: {
        'click [name=login_button]': 'login',
        'click [name=signup_button]': 'signup',
        'keypress': 'handleKeypress'
    },

    /**
     * Navigate to the `Signup` view.
     */
    signup: function() {
        app.router.navigate('#signup', {trigger: true});
    },

    /**
     * @override
     *
     * There is no need to see if there's any post login setup we need to do
     * unlike in the super class. We simply render.
     */
    postLogin: function() {
        app.$contentEl.show();
    },

    /**
     * @inheritdoc
     *
     * Remove event handler for hiding `forgot password` tooltip.
     */
    _dispose: function() {
        $(document).off('click.login');
        this._super('_dispose');
    }
})
