
/**
 * @class View.Layouts.Base.Quotes.ConfigDrawerContentLayout
 * @alias DOTB.App.view.layouts.BaseQuotesConfigDrawerContentLayout
 * @extends View.Layouts.Base.ConfigDrawerContentLayout
 */
({
    /**
     * @inheritdoc
     */
    extendsFrom: 'BaseConfigDrawerContentLayout',

    /**
     * @inheritdoc
     */
    _switchHowToData: function(helpId) {
        switch (helpId) {
            case 'config-columns':
            case 'config-summary':
            case 'config-footer':
                this.currentHowToData.title = app.lang.get('LBL_CONFIG_FIELD_SELECTOR', this.module, {
                    moduleName: app.lang.get('LBL_MODULE_NAME', this.module)
                });
                this.currentHowToData.text = '';
                break;
        }
    }
})
