

(function(app) {
    /**
     * Help Helper. Provides access for getting help for module/view specific actions
     *
     * @class Core.HelpHelper
     * @singleton
     * @alias DOTB.App.help
     */
    app.augment("help", {

        /**
         * Keep a cache of the loaded modules labels
         * @param {Object|undefined}
         */
        _moduleLabelMap: undefined,

        /**
         * Return the help text for a module and view.
         *
         * @param {String} module Module that we are currently on
         * @param {String} view The view that help text is needed for
         * @param {Object} (context) The model to use for the handlebar template
         * @return {Object} Object containing body and more_help
         */
        get: function(module, view, context) {
            var objModule = _.extend({
                'module_name': app.lang.getModuleName(module),
                'plural_module_name': app.lang.getModuleName(module, {plural: true})
            }, context || {}, this._getModuleLabelMap());
            var viewName = this._cleanupViewName(view).toUpperCase();
            return {
                'body': this._get('LBL_HELP_' + viewName, module, objModule),
                'more_help': this._get('LBL_HELP_MORE_INFO', module, objModule)
            };
        },

        /**
         * Get the label text, if the text is equal to the label name, the it will return undefined
         *
         * @param {String} label The Label we want to load
         * @param {String} module The module to look in first
         * @param {Object} context The context that should be passed to the app.lang.get call
         * @returns {String|undefined}
         * @private
         */
        _get: function(label, module, context) {
            var text = app.lang.get(label, module, context);

            if (_.isEqual(label, text)) {
                return undefined;
            }

            return text;
        },

        /**
         * Standardize the view names
         *
         * @param {String} viewName
         * @returns {String}
         * @private
         */
        _cleanupViewName: function(viewName) {
            switch(viewName.toLowerCase()) {
                case 'list':
                    return 'records';
                case 'detail':
                    return 'record';
                default:
                    return viewName;
            }
        },

        /**
         * Compile a list of modules from the moduleList and moduleListSingular language strings
         *
         * This list is passed into the app.lang.get when app.help.get is called so you can reference other modules
         * in the help text
         *
         * @return {Object}
         * @private
         */
        _getModuleLabelMap: function() {
            if (!_.isUndefined(this._moduleLabelMap)) {
                return this._moduleLabelMap;
            }
            this._moduleLabelMap = {};

            _.each(app.metadata.getModuleNames({filter: 'enabled'}), function(module) {
                var key = module.toLowerCase();
                this._moduleLabelMap[key + '_singular_module'] = app.lang.getModuleName(module);
                this._moduleLabelMap[key + '_module'] = app.lang.getModuleName(module, {plural: true});
            }, this);

            return this._moduleLabelMap;
        },

        /**
         * Clear the _moduleLabelMap variable, this happens when app:sync:complete is fired.
         */
        clearModuleLabelMap: function() {
            this._moduleLabelMap = undefined;
        },

        /**
         * Returns the URL for Dotb's Support documentation for this specific flavor/version/layout
         *
         * @param {string} [layoutName] optional The name of the layout being viewed. This defaults
         *      to 'list' if not sent ex: records|list|record etc
         * @param {string} [module] optional The name of the Module to use, defaults to getting
         *      module name from the controller context
         * @returns {string} The url to the Support docs
         */
        getMoreInfoHelpURL: function(layoutName, module) {
            layoutName = layoutName || 'list';
            module = module || app.controller.context.get('module');

            var serverInfo = app.metadata.getServerInfo(),
                lang = app.lang.getLanguage(),
                url;

            if (layoutName == 'records') {
                layoutName = 'list';
            }

            url = 'http://dotb.vn/ho-tro';

            return url;
        }
    });

    app.events.on("app:sync:complete", function() {
        app.help.clearModuleLabelMap();
    });

})(DOTB.App);
