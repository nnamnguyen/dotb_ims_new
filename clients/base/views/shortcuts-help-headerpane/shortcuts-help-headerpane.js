
/**
 * Headerpane for keyboard shortcuts help
 *
 * @class View.Views.Base.ShortcutsHelpHeaderpaneView
 * @alias DOTB.App.view.views.BaseShortcutsHelpHeaderpaneView
 * @extends View.Views.Base.HeaderpaneView
 */
({
    extendsFrom: 'HeaderpaneView',

    configureButtonName: 'configure_button',

    /**
     * Handle cancel and configure buttons.
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        this.context.on('button:cancel_button:click', function() {
            app.drawer.close();
        }, this);

        this.context.on('button:configure_button:click', this.configure, this);
    },

    /**
     * Load template for headerpane.
     * @inheritdoc
     */
    _loadTemplate: function(options) {
        var name = this.name;
        this.name = 'headerpane';
        this._super('_loadTemplate', [options]);
        this.name = name;
    },

    /**
     * Disable configure button if there are no contextual shortcuts to configure.
     * @inheritdoc
     */
    _renderHtml: function() {
        var shouldEnableConfigButton = this._shouldEnableConfigureButton();

        if (shouldEnableConfigButton) {
            this._setTooltipForConfigureButton('LBL_DASHLET_CONFIGURE');
        } else {
            this._setTooltipForConfigureButton('LBL_SHORTCUT_CONFIG_DISABLED');
        }

        this._super('_renderHtml');

        if (!shouldEnableConfigButton) {
            this._disableConfigureButton();
        }
    },

    /**
     * Should configure button be enabled?
     * @return {boolean}
     * @private
     */
    _shouldEnableConfigureButton: function() {
        var lastShortcutSession = app.shortcuts.getLastSavedSession();
        return lastShortcutSession && !_.isEmpty(lastShortcutSession.getRegisteredShortcuts());
    },

    /**
     * Set tooltip label for the configure button.
     * @param {string} tooltip tooltip label to be displayed
     * @private
     */
    _setTooltipForConfigureButton: function(tooltip) {
        var configureButtonViewDef = _.find(this.meta.buttons, function(button) {
            return (button.name === this.configureButtonName);
        }, this);

        if (configureButtonViewDef) {
            configureButtonViewDef.tooltip = tooltip;
        }
    },

    /**
     * Disable configure button.
     * @private
     */
    _disableConfigureButton: function() {
        var configureButton = this.getField(this.configureButtonName);
        if (configureButton) {
            configureButton.setDisabled(true);
        }
    },

    /**
     * Open the drawer to configure shortcut keys.
     */
    configure: function() {
        var self = this;

        app.drawer.open({
            layout: 'shortcuts-config',
            context: {
                shortcutSession: app.shortcuts.getLastSavedSession()
            }
        }, function(shouldRefresh) {
            if (shouldRefresh) {
                self.context.trigger('shortcuts:help:render');
            }
        });
    }
})
