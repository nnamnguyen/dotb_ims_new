
/**
 * @class View.Layouts.Base.OpportunitiesConfigDrawerLayout
 * @alias DOTB.App.view.layouts.BaseOpportunitiesConfigDrawerLayout
 * @extends View.Layouts.Base.ConfigDrawerLayout
 */
({
    extendsFrom: 'ConfigDrawerLayout',

    /**
     * Checks Opportunities ACLs to see if the User is a system admin
     * or if the user has a developer role for the Opportunities module
     *
     * @inheritdoc
     */
    _checkModuleAccess: function() {
        var acls = app.user.getAcls().Opportunities,
            isSysAdmin = (app.user.get('type') == 'admin'),
            isDev = (!_.has(acls, 'developer'));

        return (isSysAdmin || isDev);
    }
})
