

({
    // TODO: Remove this View completely, when it is possible to place a standard help-dashlet to the Create layout

    /**
     * @inheritdoc
     */
    _renderHtml: function () {
        var helpUrl = {
                more_info_url: this.createMoreHelpLink(),
                more_info_url_close: '</a>'
            },
            helpObject = app.help.get(this.context.get('module'), 'create', helpUrl);

        this._super('_renderHtml', [helpObject, this.options]);
    },

    /**
     * Collects server version, language, module, and route and returns an HTML link to be used
     * in the template
     *
     * @returns {string} The HTML a-tag for the More Help link
     */
    createMoreHelpLink: function () {
        var serverInfo = app.metadata.getServerInfo(),
            lang = app.lang.getLanguage(),
            module = app.controller.context.get('module'),
            route = 'create';

        var url = 'http://www.dotbcrm.com/crm/product_doc.php?edition=' + serverInfo.flavor
            + '&version=' + serverInfo.version + '&lang=' + lang + '&module=' + module + '&route=' + route;

        return '<a href="' + url + '" target="_blank">';
    }
})
