
/**
 * @inheritdoc
 *
 * @class View.Views.PortalModuleListLayout
 * @alias DOTB.App.view.layouts.PortalModuleListLayout
 */
({
    extendsFrom: 'moduleListLayout',

    /**
     * @inheritdoc
     *
     * Overloading this because for portal we dont need to add or remove
     * unmapped modules.
     * See the second `return this;` statement.
     */
    _setActiveModule: function(module) {

        if (_.isEmpty(this._components)) {
            // wait until we have the mega menu in place
            return this;
        }

        var mappedModule = app.metadata.getTabMappedModule(module);

        this.$('[data-container=module-list]').children('.active').removeClass('active');
        // for portal don't add unmapped modules
        if (!this._catalog[mappedModule]) {
            return;
        }

        this._catalog[mappedModule].long.addClass('active');
        this.toggleModule(mappedModule, true);

        return this;
    }

})
