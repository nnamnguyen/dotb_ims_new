
/**
 * @class View.Layouts.Base.ShortcutsConfigLayout
 * @alias DOTB.App.view.layouts.BaseShortcutsConfigLayout
 * @extends View.Layout
 */
({
    plugins: ['ShortcutSession'],

    shortcuts: [
        'Headerpane:Cancel',
        'Headerpane:Save'
    ],

    /**
     * @inheritdoc
     */
    _placeComponent: function(component) {
        this.$('[data-action=render]').append(component.el);
    },

    /**
     * Do not fetch data.
     */
    loadData: $.noop
})
