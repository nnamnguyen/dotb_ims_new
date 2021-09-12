
/**
 * @class View.Layouts.Base.ShortcutsLayout
 * @alias DOTB.App.view.layouts.BaseShortcutsLayout
 * @extends View.Layout
 */
({
    plugins: ['ShortcutSession'],

    shortcuts: ['Headerpane:Cancel'],

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
