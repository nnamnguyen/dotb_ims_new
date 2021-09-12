
/**
 * @class View.Layouts.Base.DupecheckFilterLayout
 * @alias DOTB.App.view.layouts.BaseDupecheckFilterLayout
 * @extends View.Layouts.Base.Filter
 */
({
    extendsFrom: 'FilterLayout',
    initialFilter: 'all_records',

    initialize: function(options) {
        this._super('initialize', [options]);
        this.name = 'filter';

        //initialize the last filter to show all duplicates before allowing user to change the filter
        this.setLastFilter(this.module, this.layoutType, this.initialFilter);
    },

    /**
     * @inheritdoc
     *
     * Override getting relevant context logic in order to filter on current
     * context.
     */
    getRelevantContextList: function() {
        return [this.context];
    },

    /**
     * @inheritdoc
     *
     * Override getting last filter in order to retrieve found duplicates for
     * initial set.
     */
    getLastFilter: function() {
        var lastFilter = this._super('getLastFilter', arguments);
        return (_.isUndefined(lastFilter)) ? this.initialFilter : lastFilter;
    }
})
