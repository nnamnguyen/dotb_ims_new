
/**
 * This view is used in Administration > Studio Portal > Theme Portal
 * in order to show a preview of the custom theme being edited.
 *
 * @class View.Views.Base.ThemerollerpreviewView
 * @alias DOTB.App.view.views.BaseThemerollerpreviewView
 * @extends View.View
 */
({
    /**
     * @inheritdoc
     */
    initialize: function(options) {
        this._super('initialize', [options]);
        /**
         * The name of the theme being edited.
         *
         * @property {string}
         */
        this.customTheme = 'default';
        this.context.on('change:colors', this.reloadIframeBootstrap, this);
    },

    /**
     * Makes a request to get new CSS based on the themeable colors, and updates
     * the theme preview on success.
     */
    reloadIframeBootstrap: function() {
        var self = this;
        var params = {
            preview: new Date().getTime(),
            platform: app.config.platform,
            themeName: this.customTheme
        };
        _.extend(params, this.context.get('colors'));
        var cssLink = app.api.buildURL('css/preview', '', {}, params);
        var $iframe = this.$('iframe#previewTheme');
        var $alert = this.$('.ajaxLoading');

        $iframe.hide();
        $alert.show();

        $.get(cssLink)
            .success(function(data) {
                if (self.disposed) {
                    return;
                }
                $iframe.contents().find('style').text(data);
                $alert.hide();
                $iframe.show();
            });
        $iframe.contents().find('body').css('backgroundColor', 'transparent');
    },

    /**
     * @inheritdoc
     */
    _renderHtml: function() {
        if (!app.acl.hasAccess('admin', 'Administration')) {
            return;
        }
        this._super('_renderHtml');
    }
})
