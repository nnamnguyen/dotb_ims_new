
/**
 * Adds ability switch modules with filter module dropdown.
 *
 * Part of {@link View.Layouts.Base.SelectionListModuleSwitchLayout}.
 *
 * @class View.Views.Base.FilterModuleDropdownSelectionListView
 * @alias DOTB.App.view.views.BaseFilterModuleDropdownSelectionListView
 * @extends View.Views.Base.FilterModuleDropdownView
 */
({
    extendsFrom: 'FilterModuleDropdownView',

    /**
     * @inheritdoc
     */
    initialize: function(options) {
        options.template = app.template.get('filter-module-dropdown');
        this._super('initialize', [options]);
    },

    /**
     * @inheritdoc
     * @return {Object}
     */
    getFilterList: function() {
        var filterList = this.context.get('filterList');

        if (this.layout.showingActivities) {
            filterList = this._super('getFilterList');
        }

        return filterList;
    },

    /**
     * @inheritdoc
     * @return {boolean}
     */
    shouldDisableFilter: function() {
        return false;
    },

    /**
     * Set the value of the filter to be the current module.
     * @private
     */
    _renderDropdown: function() {
        this._super('_renderDropdown');
        if (this.filterNode) {
            this.filterNode.select2('val', this.module);
        }
    },

    /**
     * Trigger event to reload the layout when the module changes.
     * @param {String} linkModuleName
     * @param {String} linkName
     * @param {Boolean} silent
     */
    handleChange: function(linkModuleName, linkName, silent) {
        if (!silent) {
            this.context.trigger('selection-list:reload', linkModuleName);
        }
    },

    /**
     * Always returns the module with a downward-facing caret button for
     * selecting other modules.
     *
     * @return {string}
     */
    getSelectionLabel: function() {
        return app.lang.get('LBL_MODULE') + '<i class="fa fa-caret-down"></i>';
    }
})
