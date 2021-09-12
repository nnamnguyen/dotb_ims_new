
/**
 * @class View.Layouts.Base.KBContentsConfigDrawerContentLayout
 * @alias DOTB.App.view.layouts.BaseKBContentsConfigDrawerContentLayout
 * @extends View.Layouts.Base.ConfigDrawerContentLayout
 */
({
    extendsFrom: 'ConfigDrawerContentLayout',

    /**
     * @inheritdoc
     * @override
     */
    _switchHowToData: function(helpId) {
        switch (helpId) {
            case 'config-languages':
                this.currentHowToData.title = app.lang.get(
                    'LBL_CONFIG_LANGUAGES_TITLE',
                    this.module
                );
                this.currentHowToData.text = app.lang.get(
                    'LBL_CONFIG_LANGUAGES_TEXT',
                    this.module
                );
                break;
        }
    }
})
