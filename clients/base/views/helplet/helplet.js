
/**
 * A `helplet` is a view similar to a dashlet thats lives in the help
 * component.
 *
 * TODO: SC-4808: Once MAR-2995 gets merged, we can instead have a collection of
 * helplet views that get iterated over in a helplet-list layout. This will
 * improve performance and provide better flexibility for managing independent
 * helplets.
 *
 * @class View.Views.Base.HelpletView
 * @alias DOTB.App.view.views.BaseHelpletView
 * @extends View.View
 */
({
    /**
     * Holds the Object returned by `app.help.get()`. Example:
     * <pre><code>
     * {
     *    body: '',
     *    more_help: ''
     * }
     * </code></pre>
     *
     * @type {Object}
     */
    helpObject: {},

    /**
     * Boolean to indicate if the current view's tour is enabled.
     *
     * @type {boolean} `true` if tour is enabled, otherwise `false`.
     * @private
     */
    _tourEnabled: false,

    events: {
        'click [data-action=tour]': 'showTour'
    },

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        this.createHelpObject();
        this.on('render', this.toggleTourLink, this);
    },

    /**
     * Checks if the current view's tour is enabled.
     *
     * @return {boolean} `true` if tour is enabled, otherwise `false`.
     */
    isTourEnabled: function() {
        return this._tourEnabled;
    },

    /**
     * Method to fetch the help object from the app.help utility.
     */
    createHelpObject: function() {
        var helpUrl = {
            more_info_url: this._createMoreHelpLink(),
            more_info_url_close: '</a>'
        };
        var ctx = this.context.parent || this.context;
        this.helpObject = app.help.get(ctx.get('module'), ctx.get('layout'), helpUrl);
    },

    /**
     * Method to set the `tourEnabled` flag based on current module and layout.
     */
    toggleTourLink: function() {
        var ctx = app.controller.context;
        if (app.tutorial.hasTutorial(ctx.get('layout'), ctx.get('module'))) {
            this._tourEnabled = true;
            this.$('[data-action=tour]').removeClass('disabled');
        } else {
            this._tourEnabled = false;
            this.$('[data-action=tour]').addClass('disabled');
        }
    },

    /**
     * Click handler for tour link.
     *
     * Displays the tour and closes the help popup.
     */
    showTour: function() {
        if (!this.isTourEnabled() || app.tutorial.instance) {
            return;
        }

        var ctx = app.controller.context;
        var helpLayout = this.layout.closestComponent('help');
        if (helpLayout && !helpLayout.disposed) {
            helpLayout.toggle(false);
        }

        app.tutorial.resetPrefs();
        app.tutorial.show(ctx.get('layout'), {module: ctx.get('module')});
    },

    /**
     * Collects server version, language, module, and route and returns an HTML
     * link to be used in the template.
     *
     * @private
     * @return {string} The anchor tag for the 'More Help' link.
     */
    _createMoreHelpLink: function() {
        return '<a href="https://support.dotb.vn" target="_blank">';
    }
})
