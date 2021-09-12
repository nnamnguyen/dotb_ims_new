
/**
 * @class View.Fields.Portal.FileField
 * @alias DOTB.App.view.fields.PortalFileField
 * @extends View.Fields.Base.FileField
 */
({
    extendsFrom:'FileField',
    /**
     * This is overriden by portal in order to prepend site url
     * @param {String} uri
     * @return {string} formatted uri
     */
    formatUri: function(uri) {
        return app.config.siteUrl + '/' + uri;
    }
})
