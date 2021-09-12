
 /**
 * @class View.Fields.Base.Emails.NameField
 * @alias DOTB.App.view.fields.BaseEmailsNameField
 * @extends View.Fields.Base.NameField
 */
({
    extendsFrom: 'BaseNameField',

    /**
     * @inheritdoc
     *
     * Returns "(no subject)" when the email has no subject and not in edit
     * mode. This allows for the subject to be a link in a list view.
     */
    format: function(value) {
        if (_.isEmpty(value) && this.action !== 'edit') {
            return app.lang.get('LBL_NO_SUBJECT', this.module);
        }

        return value;
    },

    /**
     * Build email record route depending on whether or not the email is a
     * draft and whether the user has the Dotb Email Client option enabled.
     *
     * @return {string}
     */
    buildHref: function() {
        var action = this.def.route && this.def.route.action ? this.def.route.action : null;
        var module = this.model.module || this.context.get('module');

        if (this.model.get('state') === 'Draft' &&
            app.acl.hasAccessToModel('edit', this.model) &&
            this._useDotbEmailClient() &&
            !action
        ) {
            action = 'compose';
        }

        return '#' + app.router.buildRoute(module, this.model.get('id'), action);
    },

    /**
     * Determine if the user is configured to use the Dotb Email Client for
     * editing existing draft emails.
     *
     * @return {boolean}
     * @private
     */
    _useDotbEmailClient: function() {
        var emailClientPreference = app.user.getPreference('email_client_preference');

        return (
            emailClientPreference &&
            emailClientPreference.type === 'dotb' &&
            app.acl.hasAccess('edit', 'Emails')
        );
    }
})
