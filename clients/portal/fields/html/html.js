
/**
 * @class View.Fields.Portal.HtmlField
 * @alias DOTB.App.view.fields.PortalHtmlField
 * @extends View.Fields.Base.HtmlField
 */
({
    extendsFrom:'HtmlField',

    /**
     * This is overridden by portal in order to prepend site url to src attributes of img tag
     * @param {String} value
     * @return {string} formatted value
     */
    format: function(value) {
        return value ?
            value.replace(/(src=")(?!http:\/\/|https:\/\/)(.*?)"/g, '$1' + app.config.siteUrl + '/$2"') :
            value;
    }
})
