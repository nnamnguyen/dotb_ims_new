
/**
 * @class View.Layouts.Base.KBContentsConfigDrawerLayout
 * @alias DOTB.App.view.layouts.BaseKBContentsConfigDrawerLayout
 * @extends View.Layouts.Base.ConfigDrawerLayout
 */
({

    extendsFrom: 'ConfigDrawerLayout',

    /**
     * @inheritdoc
     */
    _checkModuleAccess: function() {
        var acls = app.user.getAcls().KBContents,
            isSysAdmin = (app.user.get('type') == 'admin'),
            isAdmin = (!_.has(acls, 'admin'));
        isDev = (!_.has(acls, 'developer'));
        return (isSysAdmin || isAdmin || isDev);
    }
})
